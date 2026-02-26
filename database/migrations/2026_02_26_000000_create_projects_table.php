<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table): void {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('stage', 50);

            $table->string('design_status', 20)->default('pending');
            $table->string('frontend_status', 20)->default('pending');
            $table->string('backend_status', 20)->default('pending');
            $table->string('overall_status', 20)->default('pending');

            $table->timestamp('design_due_at')->nullable();
            $table->timestamp('frontend_due_at')->nullable();
            $table->timestamp('backend_due_at')->nullable();

            $table->foreignId('project_manager_id')->constrained('users');
            $table->foreignId('designer_id')->constrained('users');
            $table->foreignId('frontend_developer_id')->constrained('users');
            $table->foreignId('backend_developer_id')->constrained('users');

            $table->string('tencent_template_id', 100);
            $table->string('tencent_test_doc_id', 100)->nullable();
            $table->string('tencent_test_doc_url')->nullable();

            $table->timestamps();
            $table->index(['stage', 'overall_status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
