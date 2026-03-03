<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\DisciplineStatus;
use App\Enums\ProjectStage;
use App\Support\ProjectPermissionService;
use Illuminate\Contracts\View\View;

class ProjectPageController extends Controller
{
    public function __construct(
        protected ProjectPermissionService $permissionService,
    ) {
    }

    public function index(): View
    {
        return view('projects.index', $this->sharedData());
    }

    public function create(): View
    {
        return view('projects.create', $this->sharedData());
    }

    public function show(int $projectId): View
    {
        return view('projects.show', [
            ...$this->sharedData(),
            'projectId' => $projectId,
        ]);
    }

    public function edit(int $projectId): View
    {
        return view('projects.edit', [
            ...$this->sharedData(),
            'projectId' => $projectId,
        ]);
    }

    protected function sharedData(): array
    {
        return [
            'stages' => array_map(static fn (ProjectStage $stage): string => $stage->value, ProjectStage::cases()),
            'statuses' => array_map(static fn (DisciplineStatus $status): string => $status->value, DisciplineStatus::cases()),
            'permissions' => $this->permissionService->listForUser(auth()->user()),
        ];
    }
}
