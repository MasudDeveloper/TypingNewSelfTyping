<?php

namespace App\Http\Controllers;

use App\Models\TypingTest;
use App\Models\TestResult;
use App\Services\BijoyConverter;
use Illuminate\Http\Request;

class TypingTestController extends Controller
{
    public function show(TypingTest $test)
    {
        // Check premium access
        $user = auth()->user();
        $hasActiveSub = $user->subscription_expires_at && $user->subscription_expires_at > now();
        
        if ($test->is_premium && !$hasActiveSub && $user->role === 'student') {
            return redirect()->route('packages.index')->with('error', 'এই ল্যাবটি অ্যাক্সেস করতে অনুগ্রহ করে একটি সাবস্ক্রিপশন প্যাকেজ চালু করুন।');
        }

        return view('student.test', compact('test'));
    }

    public function submit(Request $request, TypingTest $test)
    {
        $request->validate([
            'time_taken_seconds' => 'required|numeric|min:1',
            'gross_wpm' => 'nullable|numeric',
            'total_keystrokes' => 'nullable|numeric',
            'backspace_count' => 'nullable|numeric',
            'tab_switch_warnings' => 'nullable|numeric',
            'typed_text' => 'nullable|string',
        ]);

        $timeTakenSeconds = max(1, (int) $request->time_taken_seconds);
        $timeMinutes = $timeTakenSeconds / 60;
        $mode = $test->mode ?? 'screen';
        $typedText = $request->typed_text ?? '';
        $masterContent = $test->content;

        if ($mode === 'sheet') {
            // Auto-convert and normalize both Avro Unicode and Bijoy ANSI
            $normalizedTyped = BijoyConverter::convert($typedText);
            $normalizedMaster = BijoyConverter::convert($masterContent);

            // Sheet Mode Evaluation using Word Diff / Comparison Algorithm
            $eval = $this->evaluateSheetMode($normalizedMaster, $normalizedTyped, $timeMinutes);
            
            $grossWpm = $eval['gross_wpm'];
            $netWpm = $eval['net_wpm'];
            $accuracy = $eval['accuracy'];
            $totalErrors = $eval['total_errors'];
            $totalWords = $eval['total_words'];
            $correctWords = $eval['correct_words'];
            $wrongWords = $eval['wrong_words'];
            $omittedWords = $eval['omitted_words'];
            $extraWords = $eval['extra_words'];
            $errorPercentage = $eval['error_percentage'];
            $totalKeystrokes = $request->total_keystrokes ?? mb_strlen($typedText);
            $evaluationDetails = $eval['diff'];
        } else {
            // Screen Mode Evaluation (Word-by-word real-time stream)
            $totalKeystrokes = (int) ($request->total_keystrokes ?? 0);
            $correctWords = (int) ($request->correct_words ?? 0);
            $wrongWords = (int) ($request->wrong_words ?? 0);
            $totalErrors = (int) ($request->total_errors ?? $wrongWords);
            $totalWords = (int) ($request->total_words ?? ($correctWords + $wrongWords));
            
            // Standard Gross WPM: (Total Keystrokes / 5) / TimeInMinutes OR (Total Words / TimeInMinutes)
            $grossWpm = $totalKeystrokes > 0 
                ? round(($totalKeystrokes / 5) / $timeMinutes) 
                : round($totalWords / $timeMinutes);
                
            // BCC Net WPM Formula: Gross WPM - (Errors / TimeMinutes)
            $errorPenalty = round($totalErrors / $timeMinutes);
            $netWpm = max(0, round($grossWpm - $errorPenalty));
            
            // Error Percentage: (Total Errors / Total Attempted Words) * 100
            $errorPercentage = $totalWords > 0 ? round(($totalErrors / $totalWords) * 100, 2) : 0;
            
            // Accuracy: ((Total Attempted - Total Errors) / Total Attempted) * 100
            $accuracy = $totalWords > 0 ? max(0, round((($totalWords - $totalErrors) / $totalWords) * 100, 2)) : 100;

            $omittedWords = 0;
            $extraWords = 0;
            $evaluationDetails = null;
        }

        // BCC & Govt Standard Pass/Fail Criteria:
        // 1. Net WPM must meet or exceed required pass_wpm
        // 2. Error percentage must NOT exceed 5% (Government 5% Max Error Rule)
        $speedPassed = $netWpm >= $test->pass_wpm;
        $errorPassed = $errorPercentage <= 5.0;
        $isPassed = $speedPassed && $errorPassed;

        $result = TestResult::create([
            'user_id' => auth()->id(),
            'typing_test_id' => $test->id,
            'gross_wpm' => $grossWpm,
            'net_wpm' => $netWpm,
            'total_keystrokes' => $totalKeystrokes,
            'total_words' => $totalWords,
            'correct_words' => $correctWords,
            'wrong_words' => $wrongWords,
            'omitted_words' => $omittedWords,
            'extra_words' => $extraWords,
            'accuracy' => $accuracy,
            'error_percentage' => $errorPercentage,
            'total_errors' => $totalErrors,
            'backspace_count' => (int) ($request->backspace_count ?? 0),
            'tab_switch_warnings' => (int) ($request->tab_switch_warnings ?? 0),
            'time_taken_seconds' => $timeTakenSeconds,
            'is_passed' => $isPassed,
            'typed_text' => $typedText,
            'evaluation_details' => $evaluationDetails,
        ]);

        return response()->json([
            'success' => true,
            'redirect' => route('test.result', $result->id),
            'message' => 'পরীক্ষার ফলাফল সফলভাবে সংরক্ষিত হয়েছে!'
        ]);
    }

    public function result(TestResult $result)
    {
        if ($result->user_id !== auth()->id() && auth()->user()->role === 'student') {
            abort(403);
        }

        $result->load(['typingTest', 'user']);
        
        return view('student.result', compact('result'));
    }

    /**
     * Government / BCC Standard Full Passage Diff Algorithm for Sheet Mode
     */
    private function evaluateSheetMode(string $masterText, string $typedText, float $timeMinutes): array
    {
        $masterWords = preg_split('/\s+/u', trim($masterText), -1, PREG_SPLIT_NO_EMPTY);
        $typedWords = preg_split('/\s+/u', trim($typedText), -1, PREG_SPLIT_NO_EMPTY);

        $totalMasterWords = count($masterWords);
        $totalTypedWords = count($typedWords);

        $correctCount = 0;
        $wrongCount = 0;
        $omittedCount = 0;
        $extraCount = 0;
        $diffTokens = [];

        $mIdx = 0;
        $tIdx = 0;

        while ($mIdx < $totalMasterWords && $tIdx < $totalTypedWords) {
            $mWord = $masterWords[$mIdx];
            $tWord = $typedWords[$tIdx];

            if ($mWord === $tWord) {
                // Exact match
                $correctCount++;
                $diffTokens[] = ['type' => 'correct', 'word' => $tWord];
                $mIdx++;
                $tIdx++;
            } else {
                // Check if next typed word matches current master word (extra word typed)
                $nextTypedMatches = ($tIdx + 1 < $totalTypedWords && $typedWords[$tIdx + 1] === $mWord);
                // Check if next master word matches current typed word (omitted word)
                $nextMasterMatches = ($mIdx + 1 < $totalMasterWords && $masterWords[$mIdx + 1] === $tWord);

                if ($nextTypedMatches) {
                    $extraCount++;
                    $diffTokens[] = ['type' => 'extra', 'word' => $tWord];
                    $tIdx++;
                } elseif ($nextMasterMatches) {
                    $omittedCount++;
                    $diffTokens[] = ['type' => 'omitted', 'word' => $mWord];
                    $mIdx++;
                } else {
                    // Mismatched / Spelling mistake
                    $wrongCount++;
                    $diffTokens[] = ['type' => 'wrong', 'word' => $tWord, 'expected' => $mWord];
                    $mIdx++;
                    $tIdx++;
                }
            }
        }

        // Remaining omitted words in master passage
        while ($mIdx < $totalMasterWords) {
            $omittedCount++;
            $diffTokens[] = ['type' => 'omitted', 'word' => $masterWords[$mIdx]];
            $mIdx++;
        }

        // Remaining extra words in typed passage
        while ($tIdx < $totalTypedWords) {
            $extraCount++;
            $diffTokens[] = ['type' => 'extra', 'word' => $typedWords[$tIdx]];
            $tIdx++;
        }

        $totalErrors = $wrongCount + $omittedCount + $extraCount;
        $totalAttemptedWords = max(1, $totalTypedWords);

        $charCount = mb_strlen(trim($typedText));
        $grossWpm = round(($charCount / 5) / $timeMinutes);
        $errorPenalty = round($totalErrors / $timeMinutes);
        $netWpm = max(0, round($grossWpm - $errorPenalty));

        $errorPercentage = round(($totalErrors / $totalAttemptedWords) * 100, 2);
        $accuracy = max(0, round((($totalAttemptedWords - $totalErrors) / $totalAttemptedWords) * 100, 2));

        return [
            'gross_wpm' => $grossWpm,
            'net_wpm' => $netWpm,
            'accuracy' => $accuracy,
            'error_percentage' => $errorPercentage,
            'total_errors' => $totalErrors,
            'total_words' => $totalAttemptedWords,
            'correct_words' => $correctCount,
            'wrong_words' => $wrongCount,
            'omitted_words' => $omittedCount,
            'extra_words' => $extraCount,
            'diff' => $diffTokens,
        ];
    }
}
