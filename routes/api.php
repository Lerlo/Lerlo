<?php

use App\Http\Controllers\ProjectController;
use App\Http\Middleware\EnsureProjectPermission;
use App\Support\ProjectPermissionMap;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function (): void {
    Route::get('/projects', [ProjectController::class, 'index'])
        ->middleware(EnsureProjectPermission::class . ':' . ProjectPermissionMap::VIEW);

    Route::get('/projects/{project}', [ProjectController::class, 'show'])
        ->middleware(EnsureProjectPermission::class . ':' . ProjectPermissionMap::VIEW);

    Route::post('/projects', [ProjectController::class, 'store'])
        ->middleware(EnsureProjectPermission::class . ':' . ProjectPermissionMap::CREATE);

    Route::match(['put', 'patch'], '/projects/{project}', [ProjectController::class, 'update'])
        ->middleware(EnsureProjectPermission::class . ':' . ProjectPermissionMap::UPDATE_ANY);

    Route::delete('/projects/{project}', [ProjectController::class, 'destroy'])
        ->middleware(EnsureProjectPermission::class . ':' . ProjectPermissionMap::DELETE);
});
