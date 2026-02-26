<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectRequest;
use App\Models\Project;
use App\Services\TencentDocsService;
use Illuminate\Http\JsonResponse;

class ProjectController extends Controller
{
    public function __construct(
        protected TencentDocsService $tencentDocsService,
    ) {
    }

    public function index(): JsonResponse
    {
        return response()->json(Project::query()->latest()->paginate());
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
}
