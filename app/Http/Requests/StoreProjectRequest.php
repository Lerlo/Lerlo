<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Enums\DisciplineStatus;
use App\Enums\ProjectStage;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreProjectRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'stage' => ['required', Rule::enum(ProjectStage::class)],
            'design_status' => ['required', Rule::enum(DisciplineStatus::class)],
            'frontend_status' => ['required', Rule::enum(DisciplineStatus::class)],
            'backend_status' => ['required', Rule::enum(DisciplineStatus::class)],
            'overall_status' => ['required', Rule::enum(DisciplineStatus::class)],
            'design_due_at' => ['nullable', 'date'],
            'frontend_due_at' => ['nullable', 'date'],
            'backend_due_at' => ['nullable', 'date'],
            'project_manager_id' => ['required', 'integer', 'exists:users,id'],
            'designer_id' => ['required', 'integer', 'exists:users,id'],
            'frontend_developer_id' => ['required', 'integer', 'exists:users,id'],
            'backend_developer_id' => ['required', 'integer', 'exists:users,id'],
            'tencent_template_id' => ['required', 'string', 'max:100'],
        ];
    }
}
