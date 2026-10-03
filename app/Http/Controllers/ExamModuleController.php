<?php

namespace App\Http\Controllers;

use App\Models\McqExam;
use App\Models\PracticalQuestion;
use App\Models\WrittenQuestion;
use Illuminate\Http\Request;

class ExamModuleController extends Controller
{
    public function mcqIndex()
    {
        $exams = McqExam::withCount('questions')->where('is_active', true)->get();
        return view('student.mcq.index', compact('exams'));
    }

    public function mcqShow(McqExam $exam)
    {
        $exam->load('questions');
        return view('student.mcq.exam', compact('exam'));
    }

    public function mcqSubmit(Request $request, McqExam $exam)
    {
        $exam->load('questions');
        $answers = $request->input('answers', []);

        $totalQuestions = $exam->questions->count();
        $correctCount = 0;
        $wrongCount = 0;
        $unansweredCount = 0;
        $evaluatedQuestions = [];

        foreach ($exam->questions as $q) {
            $selected = $answers[$q->id] ?? null;
            $isCorrect = false;

            if ($selected === null) {
                $unansweredCount++;
                $status = 'unanswered';
            } elseif ($selected === $q->correct_option) {
                $correctCount++;
                $isCorrect = true;
                $status = 'correct';
            } else {
                $wrongCount++;
                $status = 'wrong';
            }

            $evaluatedQuestions[] = [
                'question' => $q,
                'selected' => $selected,
                'is_correct' => $isCorrect,
                'status' => $status,
            ];
        }

        // Scoring: 1 mark per question, minus negative marking for wrong
        $marksPerQuestion = $totalQuestions > 0 ? ($exam->total_marks / $totalQuestions) : 1;
        $negativePerWrong = $exam->negative_marking ?? 0.25;
        
        $obtainedMarks = max(0, ($correctCount * $marksPerQuestion) - ($wrongCount * $negativePerWrong));
        $isPassed = $obtainedMarks >= $exam->pass_marks;

        return view('student.mcq.result', compact(
            'exam',
            'totalQuestions',
            'correctCount',
            'wrongCount',
            'unansweredCount',
            'obtainedMarks',
            'isPassed',
            'evaluatedQuestions'
        ));
    }

    public function writtenIndex()
    {
        $questions = WrittenQuestion::latest()->get();
        return view('student.written.index', compact('questions'));
    }

    public function practicalIndex()
    {
        $questions = PracticalQuestion::latest()->get();
        return view('student.practical.index', compact('questions'));
    }
}
