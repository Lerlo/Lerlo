<?php

declare(strict_types=1);

namespace App\Support;

use Illuminate\Contracts\Auth\Authenticatable;

class ProjectPermissionService
{
    public function can(?Authenticatable $user, string $permission): bool
    {
        if (!$user) {
            return false;
        }

        $role = (string) data_get($user, 'role', '');
        $extraPermissions = data_get($user, 'permissions', []);

        if (is_string($extraPermissions)) {
            $decoded = json_decode($extraPermissions, true);
            $extraPermissions = is_array($decoded) ? $decoded : [];
        }

        $rolePermissions = ProjectPermissionMap::rolePermissions()[$role] ?? [];
        $allPermissions = array_unique(array_merge($rolePermissions, is_array($extraPermissions) ? $extraPermissions : []));

        if ($permission === ProjectPermissionMap::UPDATE_ANY) {
            return in_array(ProjectPermissionMap::UPDATE, $allPermissions, true)
                || in_array(ProjectPermissionMap::UPDATE_TEST_DOC, $allPermissions, true);
        }

        return in_array($permission, $allPermissions, true);
    }

    public function listForUser(?Authenticatable $user): array
    {
        if (!$user) {
            return [];
        }

        $permissions = [];
        foreach ([
            ProjectPermissionMap::VIEW,
            ProjectPermissionMap::CREATE,
            ProjectPermissionMap::UPDATE,
            ProjectPermissionMap::DELETE,
            ProjectPermissionMap::UPDATE_TEST_DOC,
            ProjectPermissionMap::UPDATE_ANY,
        ] as $permission) {
            $permissions[$permission] = $this->can($user, $permission);
        }

        return $permissions;
    }
}
