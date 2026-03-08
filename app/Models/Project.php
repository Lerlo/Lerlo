<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\DisciplineStatus;
use App\Enums\ProjectStage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'stage',
        'design_status',
        'frontend_status',
        'backend_status',
        'overall_status',
        'design_due_at',
        'frontend_due_at',
        'backend_due_at',
        'project_manager_id',
        'designer_id',
        'frontend_developer_id',
        'backend_developer_id',
        'tencent_template_id',
        'tencent_test_doc_id',
        'tencent_test_doc_url',
    ];

    protected $casts = [
        'stage' => ProjectStage::class,
        'design_status' => DisciplineStatus::class,
        'frontend_status' => DisciplineStatus::class,
        'backend_status' => DisciplineStatus::class,
        'overall_status' => DisciplineStatus::class,
        'design_due_at' => 'datetime',
        'frontend_due_at' => 'datetime',
        'backend_due_at' => 'datetime',
    ];
}
