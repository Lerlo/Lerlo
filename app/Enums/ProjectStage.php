<?php

declare(strict_types=1);

namespace App\Enums;

enum ProjectStage: string
{
    case Initiation = 'initiation';
    case Design = 'design';
    case FrontendDevelopment = 'frontend_development';
    case BackendDevelopment = 'backend_development';
    case Testing = 'testing';
    case Launch = 'launch';
}
