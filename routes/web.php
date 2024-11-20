<?php

use App\Http\Controllers\{DashboardController,
    ProfileController,
    Question\QuestionController,
    Question\QuestionLikeController,
    Question\QuestionPublishController,
    Question\QuestionUnlikeController,
    Question\QuestionUnpublishController};
use Illuminate\Support\Facades\Route;

Route::get('/', function () {

    if(app()->isLocal()) {
        auth()->loginUsingId(1);

        return to_route('dashboard');
    }

    return view('welcome');
});

Route::get('/dashboard', DashboardController::class)->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/questions', [QuestionController::class, 'index'])->name('questions.index');
    Route::post('questions/store', [QuestionController::class, 'store'])->name('questions.store');
    Route::delete('/questions/{question}', [QuestionController::class, 'destroy'])->name('questions.destroy');
    Route::post('questions/like/{question}', QuestionLikeController::class)->name('questions.like');
    Route::post('questions/unlike/{question}', QuestionUnlikeController::class)->name('questions.unlike');
    Route::put('/questions/publish/{question}', QuestionPublishController::class)->name('questions.publish');
    Route::put('/questions/unpublish/{question}', QuestionUnpublishController::class)->name('questions.unpublish');
});

require __DIR__ . '/auth.php';
