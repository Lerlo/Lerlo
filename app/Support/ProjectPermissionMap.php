<?php

declare(strict_types=1);

namespace App\Support;

use App\Enums\UserRole;

class ProjectPermissionMap
{
    public const VIEW = 'projects.view';
    public const CREATE = 'projects.create';
    public const UPDATE = 'projects.update';
    public const DELETE = 'projects.delete';
    public const UPDATE_TEST_DOC = 'projects.update_test_doc';
    public const UPDATE_ANY = 'projects.update_any';

    public static function rolePermissions(): array
    {
        return [
            UserRole::Admin->value => [
                self::VIEW,
                self::CREATE,
                self::UPDATE,
                self::DELETE,
                self::UPDATE_TEST_DOC,
                self::UPDATE_ANY,
            ],
            UserRole::ProjectManager->value => [
                self::VIEW,
                self::CREATE,
                self::UPDATE,
                self::UPDATE_TEST_DOC,
                self::UPDATE_ANY,
            ],
            UserRole::Designer->value => [
                self::VIEW,
            ],
            UserRole::FrontendDeveloper->value => [
                self::VIEW,
            ],
            UserRole::BackendDeveloper->value => [
                self::VIEW,
            ],
            UserRole::Tester->value => [
                self::VIEW,
                self::UPDATE_TEST_DOC,
                self::UPDATE_ANY,
            ],
        ];
    }
}
