<?php

namespace App\Http\Controllers;

use App\Models\Institution;
use App\Models\TestResult;
use App\Models\TypingTest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class InstitutionController extends Controller
{
    private function getInstitution()
    {
        $user = auth()->user();
        if ($user->role !== 'institution_admin' && $user->role !== 'superadmin') {
            abort(403, 'Unauthorized access to Institution Portal');
        }

        $institution = $user->institution_id ? Institution::find($user->institution_id) : Institution::first();
        if (!$institution) {
            $institution = Institution::create([
                'name' => 'Default Coaching Center',
                'slug' => 'default-coaching',
                'subscription_status' => true,
                'package_name' => 'Standard Coaching (50 Students)',
                'student_limit' => 50,
                'subscription_expires_at' => now()->addMonths(6),
            ]);
            $user->institution_id = $institution->id;
            $user->save();
        }

        return $institution;
    }

    /**
     * 1. Overview Dashboard
     */
    public function index(Request $request)
    {
        $institution = $this->getInstitution();

        $studentIds = $institution->students()->pluck('id');
        $tests = $institution->tests()->latest()->get();

        $results = TestResult::with(['user', 'typingTest'])
            ->whereIn('user_id', $studentIds)
            ->latest()
            ->take(15)
            ->get();

        $totalStudents = $institution->students()->count();
        $totalTests = $tests->count();
        $avgSpeed = $results->count() > 0 ? round($results->avg('net_wpm')) : 0;
        $passRate = $results->count() > 0 ? round(($results->where('is_passed', true)->count() / $results->count()) * 100) : 0;

        $batches = $institution->batches;

        // Top 5 students by highest net speed
        $topPerformers = TestResult::with('user')
            ->whereIn('user_id', $studentIds)
            ->orderBy('net_wpm', 'desc')
            ->take(5)
            ->get();

        return view('institution.dashboard', compact(
            'institution',
            'tests',
            'results',
            'totalStudents',
            'totalTests',
            'avgSpeed',
            'passRate',
            'batches',
            'topPerformers'
        ));
    }

    /**
     * 2. Dedicated Students Management Page
     */
    public function studentsIndex(Request $request)
    {
        $institution = $this->getInstitution();
        $search = $request->get('search');
        $selectedBatch = $request->get('batch', 'all');

        $query = $institution->students()->latest();

        if ($selectedBatch !== 'all' && !empty($selectedBatch)) {
            $query->where('batch_name', $selectedBatch);
        }

        if (!empty($search)) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('student_roll', 'like', "%{$search}%");
            });
        }

        $students = $query->paginate(20)->withQueryString();
        $batches = $institution->batches;
        $totalStudents = $institution->students()->count();

        return view('institution.students', compact(
            'institution',
            'students',
            'batches',
            'selectedBatch',
            'search',
            'totalStudents'
        ));
    }

    /**
     * 3. Dedicated Bulk Import & Export Page
     */
    public function importExportIndex()
    {
        $institution = $this->getInstitution();
        $batches = $institution->batches;
        $totalStudents = $institution->students()->count();

        return view('institution.import_export', compact('institution', 'batches', 'totalStudents'));
    }

    /**
     * 4. Dedicated Batches & Schedule Page
     */
    public function batchesIndex()
    {
        $institution = $this->getInstitution();
        $batchesList = $institution->batches;
        
        // Group students by batch to calculate stats per batch
        $batchStats = [];
        foreach ($batchesList as $batch) {
            $studentsInBatch = $institution->students()->where('batch_name', $batch)->get();
            $batchStudentIds = $studentsInBatch->pluck('id');
            
            $batchResults = TestResult::whereIn('user_id', $batchStudentIds)->get();
            $avgSpeed = $batchResults->count() > 0 ? round($batchResults->avg('net_wpm')) : 0;
            $passCount = $batchResults->where('is_passed', true)->count();
            $passRate = $batchResults->count() > 0 ? round(($passCount / $batchResults->count()) * 100) : 0;

            $batchStats[] = [
                'name' => $batch,
                'students_count' => $studentsInBatch->count(),
                'avg_speed' => $avgSpeed,
                'pass_rate' => $passRate,
                'latest_student' => $studentsInBatch->first() ? $studentsInBatch->first()->name : 'N/A',
            ];
        }

        $totalStudents = $institution->students()->count();

        return view('institution.batches', compact('institution', 'batchStats', 'totalStudents'));
    }

    /**
     * 5. Dedicated Custom Tests Management Page
     */
    public function testsIndex()
    {
        $institution = $this->getInstitution();
        $tests = $institution->tests()->latest()->paginate(15);

        return view('institution.tests', compact('institution', 'tests'));
    }

    /**
     * 6. Dedicated Settings & Branding Page
     */
    public function settingsIndex()
    {
        $institution = $this->getInstitution();
        return view('institution.settings', compact('institution'));
    }

    /**
     * Actions: Store Single Student
     */
    public function storeStudent(Request $request)
    {
        $institution = $this->getInstitution();

        // Check student capacity limit
        $currentCount = $institution->students()->count();
        if ($currentCount >= $institution->student_limit) {
            return back()->with('error', "আপনার প্যাকেজের শিক্ষার্থী সীমা ({$institution->student_limit} জন) পূর্ণ হয়ে গেছে। অনুগ্রহ করে সুপারঅ্যাডমিনের সাথে যোগাযোগ করে প্যাকেজ আপগ্রেড করুন।");
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'batch_name' => 'nullable|string|max:100',
            'student_roll' => 'nullable|string|max:50',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'student',
            'institution_id' => $institution->id,
            'batch_name' => $request->batch_name ?? 'সাধারণ ব্যাচ',
            'student_roll' => $request->student_roll,
            'subscription_expires_at' => $institution->subscription_expires_at ?? now()->addMonths(6),
        ]);

        return back()->with('success', 'শিক্ষার্থী সফলভাবে ব্যাচে অন্তর্ভুক্ত করা হয়েছে!');
    }

    /**
     * Actions: Destroy Student
     */
    public function destroyStudent(User $user)
    {
        $institution = $this->getInstitution();

        if ($user->institution_id !== $institution->id) {
            abort(403, 'Unauthorized student removal');
        }

        $user->delete();
        return back()->with('success', 'শিক্ষার্থীর তথ্য সফলভাবে মুছে ফেলা হয়েছে!');
    }

    /**
     * Actions: Bulk Import Students
     */
    public function bulkImportStudents(Request $request)
    {
        $institution = $this->getInstitution();

        $request->validate([
            'batch_name' => 'required|string|max:100',
            'csv_file' => 'nullable|file|mimes:csv,txt|max:2048',
            'raw_text' => 'nullable|string',
        ]);

        $batchName = $request->batch_name;
        $expiry = $institution->subscription_expires_at ?? now()->addMonths(6);

        $rows = [];

        if ($request->hasFile('csv_file')) {
            $handle = fopen($request->file('csv_file')->getPathname(), 'r');
            $header = fgetcsv($handle);
            while (($data = fgetcsv($handle)) !== false) {
                if (count($data) >= 2) {
                    $rows[] = [
                        'name' => trim($data[0]),
                        'email' => trim($data[1]),
                        'password' => isset($data[2]) && !empty(trim($data[2])) ? trim($data[2]) : '123456',
                        'roll' => isset($data[3]) ? trim($data[3]) : null,
                    ];
                }
            }
            fclose($handle);
        } elseif ($request->filled('raw_text')) {
            $lines = explode("\n", str_replace("\r", "", $request->raw_text));
            foreach ($lines as $line) {
                $line = trim($line);
                if (empty($line)) continue;
                $parts = array_map('trim', explode(',', $line));
                if (count($parts) >= 2) {
                    $rows[] = [
                        'name' => $parts[0],
                        'email' => $parts[1],
                        'password' => isset($parts[2]) && !empty($parts[2]) ? $parts[2] : '123456',
                        'roll' => isset($parts[3]) ? $parts[3] : null,
                    ];
                }
            }
        }

        if (empty($rows)) {
            return back()->with('error', 'কোনো সঠিক শিক্ষার্থীর তথ্য পাওয়া যায়নি। অনুগ্রহ করে সঠিক ফরম্যাটে CSV বা টেক্সট দিন।');
        }

        $imported = 0;
        $skipped = 0;
        $currentCount = $institution->students()->count();

        foreach ($rows as $row) {
            if ($currentCount + $imported >= $institution->student_limit) {
                break;
            }

            if (empty($row['email']) || !filter_var($row['email'], FILTER_VALIDATE_EMAIL)) {
                $skipped++;
                continue;
            }

            if (User::where('email', $row['email'])->exists()) {
                $skipped++;
                continue;
            }

            User::create([
                'name' => $row['name'],
                'email' => $row['email'],
                'password' => Hash::make($row['password']),
                'role' => 'student',
                'institution_id' => $institution->id,
                'batch_name' => $batchName,
                'student_roll' => $row['roll'],
                'subscription_expires_at' => $expiry,
            ]);
            $imported++;
        }

        return back()->with('success', "বাল্ক আপলোড সম্পন্ন: {$imported} জন শিক্ষার্থী অন্তর্ভুক্ত হয়েছে, {$skipped} জন বাদ পড়েছে (ডুপ্লিকেট ইমেইল বা লিমিট ওভার)।");
    }

    /**
     * Actions: Export Students
     */
    public function exportStudents(Request $request)
    {
        $institution = $this->getInstitution();
        $batch = $request->get('batch', 'all');

        $query = $institution->students();
        if ($batch !== 'all' && !empty($batch)) {
            $query->where('batch_name', $batch);
        }
        $students = $query->orderBy('name')->get();

        $filename = 'students_' . Str::slug($institution->name) . '_' . ($batch !== 'all' ? Str::slug($batch) : 'all') . '.csv';

        $headers = [
            "Content-type" => "text/csv; charset=UTF-8",
            "Content-Disposition" => "attachment; filename=$filename",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];

        $columns = ['ID', 'Name', 'Email', 'Batch', 'Roll', 'Created At'];

        $callback = function() use ($students, $columns) {
            $file = fopen('php://output', 'w');
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF)); // UTF-8 BOM
            fputcsv($file, $columns);

            foreach ($students as $stu) {
                fputcsv($file, [
                    $stu->id,
                    $stu->name,
                    $stu->email,
                    $stu->batch_name ?? 'N/A',
                    $stu->student_roll ?? 'N/A',
                    $stu->created_at->format('d M Y'),
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Actions: Update Settings & Branding
     */
    public function updateSettings(Request $request)
    {
        $institution = $this->getInstitution();

        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string|max:500',
            'tagline' => 'nullable|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:2048',
            'signature' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:2048',
        ]);

        $data = [
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
            'tagline' => $request->tagline,
        ];

        if ($request->hasFile('logo')) {
            $logoName = 'inst_logo_' . $institution->id . '_' . time() . '.' . $request->file('logo')->getClientOriginalExtension();
            $request->file('logo')->move(public_path('uploads/institution'), $logoName);
            $data['logo_path'] = '/uploads/institution/' . $logoName;
        }

        if ($request->hasFile('signature')) {
            $sigName = 'inst_sig_' . $institution->id . '_' . time() . '.' . $request->file('signature')->getClientOriginalExtension();
            $request->file('signature')->move(public_path('uploads/institution'), $sigName);
            $data['signature_path'] = '/uploads/institution/' . $sigName;
        }

        $institution->update($data);

        return back()->with('success', 'প্রতিষ্ঠানের ব্র্যান্ডিং ও যোগাযোগের তথ্য সফলভাবে সংরক্ষিত হয়েছে!');
    }

    /**
     * Actions: Store Test
     */
    public function storeTest(Request $request)
    {
        $institution = $this->getInstitution();

        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string',
            'language' => 'required|in:en,bn_unicode,bn_bijoy',
            'mode' => 'required|in:screen,sheet',
            'time_limit_minutes' => 'required|integer|min:1|max:30',
            'pass_wpm' => 'required|integer|min:10|max:100',
            'content' => 'required|string',
        ]);

        TypingTest::create([
            'title' => $request->title,
            'category' => $request->category . ' (' . $institution->name . ')',
            'language' => $request->language,
            'mode' => $request->mode,
            'time_limit_minutes' => $request->time_limit_minutes,
            'pass_wpm' => $request->pass_wpm,
            'content' => $request->content,
            'institution_id' => $institution->id,
            'is_premium' => false,
            'backspace_allowed' => true,
        ]);

        return back()->with('success', 'ইনস্টিটিউট পরীক্ষার প্যাসেজ সফলভাবে তৈরি হয়েছে!');
    }

    /**
     * Actions: Destroy Test
     */
    public function destroyTest(TypingTest $test)
    {
        $institution = $this->getInstitution();

        if ($test->institution_id !== $institution->id) {
            abort(403, 'Unauthorized test removal');
        }

        $test->delete();
        return back()->with('success', 'পরীক্ষার প্যাসেজ সফলভাবে মুছে ফেলা হয়েছে!');
    }

    /**
     * Printable Batch Report View
     */
    public function batchReport(Request $request)
    {
        $institution = $this->getInstitution();
        $batch = $request->get('batch', 'all');

        $studentsQuery = $institution->students();
        if ($batch !== 'all' && !empty($batch)) {
            $studentsQuery->where('batch_name', $batch);
        }
        $studentIds = $studentsQuery->pluck('id');

        $results = TestResult::with(['user', 'typingTest'])
            ->whereIn('user_id', $studentIds)
            ->latest()
            ->get();

        $batches = $institution->batches;

        return view('institution.report', compact('institution', 'results', 'batch', 'batches'));
    }
}
