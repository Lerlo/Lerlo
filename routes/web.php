<?php

use App\Http\Controllers\ProjectPageController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function (): void {
    Route::get('/projects', [ProjectPageController::class, 'index'])->name('projects.index');
    Route::get('/projects/create', [ProjectPageController::class, 'create'])->name('projects.create');
    Route::get('/projects/{project}', [ProjectPageController::class, 'show'])->name('projects.show');
    Route::get('/projects/{project}/edit', [ProjectPageController::class, 'edit'])->name('projects.edit');
});
