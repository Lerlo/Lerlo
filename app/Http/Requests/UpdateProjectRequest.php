<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Enums\DisciplineStatus;
use App\Enums\ProjectStage;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProjectRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['sometimes', 'required', 'string', 'max:255'],
            'description' => ['sometimes', 'nullable', 'string'],
            'stage' => ['sometimes', 'required', Rule::enum(ProjectStage::class)],
            'design_status' => ['sometimes', 'required', Rule::enum(DisciplineStatus::class)],
            'frontend_status' => ['sometimes', 'required', Rule::enum(DisciplineStatus::class)],
            'backend_status' => ['sometimes', 'required', Rule::enum(DisciplineStatus::class)],
            'overall_status' => ['sometimes', 'required', Rule::enum(DisciplineStatus::class)],
            'design_due_at' => ['sometimes', 'nullable', 'date'],
            'frontend_due_at' => ['sometimes', 'nullable', 'date'],
            'backend_due_at' => ['sometimes', 'nullable', 'date'],
            'project_manager_id' => ['sometimes', 'required', 'integer', 'exists:users,id'],
            'designer_id' => ['sometimes', 'required', 'integer', 'exists:users,id'],
            'frontend_developer_id' => ['sometimes', 'required', 'integer', 'exists:users,id'],
            'backend_developer_id' => ['sometimes', 'required', 'integer', 'exists:users,id'],
            'test_doc_content' => ['sometimes', 'required', 'string'],
        ];
    }
}
