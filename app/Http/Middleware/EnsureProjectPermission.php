<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Support\ProjectPermissionService;
use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureProjectPermission
{
    public function __construct(
        protected ProjectPermissionService $permissionService,
    ) {
    }

    public function handle(Request $request, Closure $next, string $permission): Response|JsonResponse|RedirectResponse
    {
        if (!$this->permissionService->can($request->user(), $permission)) {
            if ($request->expectsJson() || $request->is('api/*')) {
                return response()->json([
                    'message' => 'Forbidden: missing permission ' . $permission,
                ], 403);
            }

            abort(403, 'Forbidden: missing permission ' . $permission);
        }

        return $next($request);
    }
}
