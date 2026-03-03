@extends('layouts.app', ['title' => '新建立项'])

@section('content')
<section class="card">
    <h2>新建立项</h2>
    <form id="projectCreateForm" class="grid-form">
        <input name="name" placeholder="项目名称" required>
        <input name="description" placeholder="项目描述">
        <select name="stage" required>
            @foreach($stages as $stage)<option value="{{ $stage }}">{{ $stage }}</option>@endforeach
        </select>
        <select name="overall_status" required>
            @foreach($statuses as $status)<option value="{{ $status }}">{{ $status }}</option>@endforeach
        </select>
        <select name="design_status" required>
            @foreach($statuses as $status)<option value="{{ $status }}">{{ $status }}</option>@endforeach
        </select>
        <select name="frontend_status" required>
            @foreach($statuses as $status)<option value="{{ $status }}">{{ $status }}</option>@endforeach
        </select>
        <select name="backend_status" required>
            @foreach($statuses as $status)<option value="{{ $status }}">{{ $status }}</option>@endforeach
        </select>
        <input name="design_due_at" type="datetime-local">
        <input name="frontend_due_at" type="datetime-local">
        <input name="backend_due_at" type="datetime-local">
        <input name="project_manager_id" type="number" placeholder="项目经理ID" required>
        <input name="designer_id" type="number" placeholder="设计师ID" required>
        <input name="frontend_developer_id" type="number" placeholder="前端开发ID" required>
        <input name="backend_developer_id" type="number" placeholder="后端开发ID" required>
        <input name="tencent_template_id" placeholder="腾讯模板ID" required>
        <button class="btn" type="submit">创建项目</button>
    </form>
    <p id="createMessage"></p>
</section>
@endsection

@push('scripts')
<script>window.renderProjectCreatePage();</script>
@endpush
