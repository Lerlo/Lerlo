<?php

declare(strict_types=1);

namespace App\Enums;

enum UserRole: string
{
    case Admin = 'admin';
    case ProjectManager = 'project_manager';
    case Designer = 'designer';
    case FrontendDeveloper = 'frontend_developer';
    case BackendDeveloper = 'backend_developer';
    case Tester = 'tester';
}
