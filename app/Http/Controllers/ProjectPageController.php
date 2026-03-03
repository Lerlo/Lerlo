<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\DisciplineStatus;
use App\Enums\ProjectStage;
use Illuminate\Contracts\View\View;

class ProjectPageController extends Controller
{
    public function index(): View
    {
        return view('projects.index', [
            'stages' => array_map(static fn (ProjectStage $stage): string => $stage->value, ProjectStage::cases()),
            'statuses' => array_map(static fn (DisciplineStatus $status): string => $status->value, DisciplineStatus::cases()),
        ]);
    }

    public function create(): View
    {
        return view('projects.create', [
            'stages' => array_map(static fn (ProjectStage $stage): string => $stage->value, ProjectStage::cases()),
            'statuses' => array_map(static fn (DisciplineStatus $status): string => $status->value, DisciplineStatus::cases()),
        ]);
    }

    public function show(int $projectId): View
    {
        return view('projects.show', [
            'projectId' => $projectId,
            'stages' => array_map(static fn (ProjectStage $stage): string => $stage->value, ProjectStage::cases()),
            'statuses' => array_map(static fn (DisciplineStatus $status): string => $status->value, DisciplineStatus::cases()),
        ]);
    }

    public function edit(int $projectId): View
    {
        return view('projects.edit', [
            'projectId' => $projectId,
            'stages' => array_map(static fn (ProjectStage $stage): string => $stage->value, ProjectStage::cases()),
            'statuses' => array_map(static fn (DisciplineStatus $status): string => $status->value, DisciplineStatus::cases()),
        ]);
    }
}
