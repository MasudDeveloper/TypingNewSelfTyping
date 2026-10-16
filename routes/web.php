<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }
    $packages = \App\Models\Package::where('is_active', true)->get();
    $totalTests = \App\Models\TypingTest::count();
    $totalStudents = \App\Models\User::where('role', 'student')->count();
    $books = \App\Models\Book::where('is_active', true)->orderBy('sort_order', 'asc')->get();
    return view('welcome', compact('packages', 'totalTests', 'totalStudents', 'books'));
});

Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Typing Engine Routes
    Route::get('/test/{test}', [\App\Http\Controllers\TypingTestController::class, 'show'])->name('test.show');
    Route::post('/test/{test}/submit', [\App\Http\Controllers\TypingTestController::class, 'submit'])->name('test.submit');
    Route::get('/result/{result}', [\App\Http\Controllers\TypingTestController::class, 'result'])->name('test.result');

    // Subscriptions and Wallet
    Route::get('/packages', [\App\Http\Controllers\SubscriptionController::class, 'index'])->name('packages.index');
    Route::post('/wallet/recharge', [\App\Http\Controllers\SubscriptionController::class, 'recharge'])->name('wallet.recharge');
    Route::post('/packages/{package}/purchase', [\App\Http\Controllers\SubscriptionController::class, 'purchase'])->name('packages.purchase');

    // Exam Modules (MCQ, Written, Practical)
    Route::prefix('exams')->name('exams.')->group(function () {
        Route::get('/mcq', [\App\Http\Controllers\ExamModuleController::class, 'mcqIndex'])->name('mcq.index');
        Route::get('/mcq/{exam}', [\App\Http\Controllers\ExamModuleController::class, 'mcqShow'])->name('mcq.show');
        Route::post('/mcq/{exam}/submit', [\App\Http\Controllers\ExamModuleController::class, 'mcqSubmit'])->name('mcq.submit');
        
        Route::get('/written', [\App\Http\Controllers\ExamModuleController::class, 'writtenIndex'])->name('written.index');
        Route::get('/practical', [\App\Http\Controllers\ExamModuleController::class, 'practicalIndex'])->name('practical.index');
    });

    // Leaderboard (Winner Top 10)
    Route::get('/leaderboard', [\App\Http\Controllers\LeaderboardController::class, 'index'])->name('leaderboard.index');

    // SuperAdmin Routes
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [\App\Http\Controllers\SuperAdminController::class, 'index'])->name('dashboard');
        
        // Android Gateway & Recharge Management
        Route::get('/gateway', [\App\Http\Controllers\SuperAdminController::class, 'gatewayIndex'])->name('gateway.index');
        Route::post('/recharge/{transaction}/approve', [\App\Http\Controllers\SuperAdminController::class, 'approveRecharge'])->name('recharge.approve');
        Route::post('/recharge/{transaction}/reject', [\App\Http\Controllers\SuperAdminController::class, 'rejectRecharge'])->name('recharge.reject');

        // Typing Tests & Question Bank
        Route::get('/tests', [\App\Http\Controllers\SuperAdminController::class, 'testsIndex'])->name('tests.index');
        Route::post('/tests', [\App\Http\Controllers\SuperAdminController::class, 'storeTest'])->name('tests.store');
        Route::delete('/tests/{test}', [\App\Http\Controllers\SuperAdminController::class, 'destroyTest'])->name('tests.destroy');

        // Packages Management
        Route::get('/packages', [\App\Http\Controllers\SuperAdminController::class, 'packagesIndex'])->name('packages.index');

        // Book Management Routes
        Route::get('/books', [\App\Http\Controllers\SuperAdminController::class, 'booksIndex'])->name('books.index');
        Route::post('/books', [\App\Http\Controllers\SuperAdminController::class, 'storeBook'])->name('books.store');
        Route::delete('/books/{book}', [\App\Http\Controllers\SuperAdminController::class, 'destroyBook'])->name('books.destroy');

        // Institution Sales & Package Management Routes
        Route::get('/institutions', [\App\Http\Controllers\SuperAdminController::class, 'institutionsIndex'])->name('institutions.index');
        Route::post('/institutions', [\App\Http\Controllers\SuperAdminController::class, 'storeInstitution'])->name('institutions.store');
        Route::put('/institutions/{institution}', [\App\Http\Controllers\SuperAdminController::class, 'updateInstitutionSubscription'])->name('institutions.update');
    });

    // Institution Admin Routes
    Route::prefix('institution')->name('institution.')->group(function () {
        Route::get('/dashboard', [\App\Http\Controllers\InstitutionController::class, 'index'])->name('dashboard');
        
        // Students Management
        Route::get('/students', [\App\Http\Controllers\InstitutionController::class, 'studentsIndex'])->name('students.index');
        Route::post('/students', [\App\Http\Controllers\InstitutionController::class, 'storeStudent'])->name('students.store');
        Route::delete('/students/{user}', [\App\Http\Controllers\InstitutionController::class, 'destroyStudent'])->name('students.destroy');
        
        // Bulk Import & Export
        Route::get('/import-export', [\App\Http\Controllers\InstitutionController::class, 'importExportIndex'])->name('students.importPage');
        Route::post('/students/bulk-import', [\App\Http\Controllers\InstitutionController::class, 'bulkImportStudents'])->name('students.bulkImport');
        Route::get('/students/export', [\App\Http\Controllers\InstitutionController::class, 'exportStudents'])->name('students.export');
        
        // Batches Management
        Route::get('/batches', [\App\Http\Controllers\InstitutionController::class, 'batchesIndex'])->name('batches.index');
        
        // Custom Tests & Exam Module
        Route::get('/tests', [\App\Http\Controllers\InstitutionController::class, 'testsIndex'])->name('tests.index');
        Route::post('/tests', [\App\Http\Controllers\InstitutionController::class, 'storeTest'])->name('tests.store');
        Route::delete('/tests/{test}', [\App\Http\Controllers\InstitutionController::class, 'destroyTest'])->name('tests.destroy');

        // Branding & Settings
        Route::get('/settings', [\App\Http\Controllers\InstitutionController::class, 'settingsIndex'])->name('settings');
        Route::post('/settings', [\App\Http\Controllers\InstitutionController::class, 'updateSettings'])->name('settings.update');
        
        // Batch Printable Report
        Route::get('/report', [\App\Http\Controllers\InstitutionController::class, 'batchReport'])->name('report');
    });
});

require __DIR__.'/auth.php';
