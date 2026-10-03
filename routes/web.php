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
    return view('welcome', compact('packages', 'totalTests', 'totalStudents'));
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
        Route::post('/recharge/{transaction}/approve', [\App\Http\Controllers\SuperAdminController::class, 'approveRecharge'])->name('recharge.approve');
        Route::post('/recharge/{transaction}/reject', [\App\Http\Controllers\SuperAdminController::class, 'rejectRecharge'])->name('recharge.reject');
        Route::post('/tests', [\App\Http\Controllers\SuperAdminController::class, 'storeTest'])->name('tests.store');
        Route::delete('/tests/{test}', [\App\Http\Controllers\SuperAdminController::class, 'destroyTest'])->name('tests.destroy');
    });

    // Institution Admin Routes
    Route::prefix('institution')->name('institution.')->group(function () {
        Route::get('/dashboard', [\App\Http\Controllers\InstitutionController::class, 'index'])->name('dashboard');
        Route::post('/students', [\App\Http\Controllers\InstitutionController::class, 'storeStudent'])->name('students.store');
        Route::post('/tests', [\App\Http\Controllers\InstitutionController::class, 'storeTest'])->name('tests.store');
        Route::get('/report', [\App\Http\Controllers\InstitutionController::class, 'batchReport'])->name('report');
    });
});

require __DIR__.'/auth.php';
