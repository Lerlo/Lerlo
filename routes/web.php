<?php

use App\Http\Controllers\ProjectPageController;
use App\Http\Middleware\EnsureProjectPermission;
use App\Support\ProjectPermissionMap;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', EnsureProjectPermission::class . ':' . ProjectPermissionMap::VIEW])->group(function (): void {
    Route::get('/projects', [ProjectPageController::class, 'index'])->name('projects.index');
    Route::get('/projects/{project}', [ProjectPageController::class, 'show'])->name('projects.show');
});

Route::middleware(['auth', EnsureProjectPermission::class . ':' . ProjectPermissionMap::CREATE])->group(function (): void {
    Route::get('/projects/create', [ProjectPageController::class, 'create'])->name('projects.create');
});

Route::middleware(['auth', EnsureProjectPermission::class . ':' . ProjectPermissionMap::UPDATE_ANY])->group(function (): void {
    Route::get('/projects/{project}/edit', [ProjectPageController::class, 'edit'])->name('projects.edit');
});
