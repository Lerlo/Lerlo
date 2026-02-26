<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;
use App\Services\TencentDocsService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function __construct(
        protected TencentDocsService $tencentDocsService,
    ) {
    }

    public function index(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'stage' => ['nullable', 'string'],
            'overall_status' => ['nullable', 'string'],
            'project_manager_id' => ['nullable', 'integer'],
            'keyword' => ['nullable', 'string', 'max:255'],
            'per_page' => ['nullable', 'integer', 'min:1', 'max:100'],
        ]);

        $projects = Project::query()
            ->when($validated['stage'] ?? null, fn ($query, $stage) => $query->where('stage', $stage))
            ->when($validated['overall_status'] ?? null, fn ($query, $status) => $query->where('overall_status', $status))
            ->when($validated['project_manager_id'] ?? null, fn ($query, $managerId) => $query->where('project_manager_id', $managerId))
            ->when($validated['keyword'] ?? null, fn ($query, $keyword) => $query
                ->where(function ($subQuery) use ($keyword): void {
                    $subQuery->where('name', 'like', "%{$keyword}%")
                        ->orWhere('description', 'like', "%{$keyword}%");
                }))
            ->latest()
            ->paginate((int) ($validated['per_page'] ?? 15));

        return response()->json($projects);
    }

    public function show(Project $project): JsonResponse
    {
        return response()->json($project);
    }

    /**
     * 立项并自动复制腾讯文档测试模板。
     */
    public function store(StoreProjectRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $doc = $this->tencentDocsService->copyTemplate(
            $validated['tencent_template_id'],
            $validated['name'],
        );

        $project = Project::query()->create([
            ...$validated,
            'tencent_test_doc_id' => $doc['doc_id'],
            'tencent_test_doc_url' => $doc['doc_url'],
        ]);

        return response()->json($project, 201);
    }

    /**
     * 更新项目基础信息；若传 test_doc_content 则更新已复制测试文档内容，不再复制模板。
     */
    public function update(UpdateProjectRequest $request, Project $project): JsonResponse
    {
        $validated = $request->validated();
        $testDocContent = $validated['test_doc_content'] ?? null;

        unset($validated['test_doc_content']);

        if ($testDocContent !== null && $project->tencent_test_doc_id) {
            $this->tencentDocsService->updateCopiedTestDoc((string) $project->tencent_test_doc_id, $testDocContent);
        }

        $project->fill($validated);
        $project->save();

        return response()->json($project->fresh());
    }

    public function destroy(Project $project): JsonResponse
    {
        $project->delete();

        return response()->json([
            'message' => 'Project deleted successfully.',
        ]);
    }
}
