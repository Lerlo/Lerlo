@extends('layouts.app', ['title' => '编辑项目'])

@section('content')
<section class="card">
    <h2>编辑项目 #{{ $projectId }}</h2>
    <form id="projectEditForm" class="grid-form">
        <input name="name" placeholder="项目名称">
        <input name="description" placeholder="项目描述">
        <select name="stage"><option value="">不修改阶段</option>@foreach($stages as $stage)<option value="{{ $stage }}">{{ $stage }}</option>@endforeach</select>
        <select name="overall_status"><option value="">不修改综合状态</option>@foreach($statuses as $status)<option value="{{ $status }}">{{ $status }}</option>@endforeach</select>
        <select name="design_status"><option value="">不修改设计状态</option>@foreach($statuses as $status)<option value="{{ $status }}">{{ $status }}</option>@endforeach</select>
        <select name="frontend_status"><option value="">不修改前端状态</option>@foreach($statuses as $status)<option value="{{ $status }}">{{ $status }}</option>@endforeach</select>
        <select name="backend_status"><option value="">不修改后端状态</option>@foreach($statuses as $status)<option value="{{ $status }}">{{ $status }}</option>@endforeach</select>
        <input name="project_manager_id" type="number" placeholder="项目经理ID">
        <input name="designer_id" type="number" placeholder="设计师ID">
        <input name="frontend_developer_id" type="number" placeholder="前端开发ID">
        <input name="backend_developer_id" type="number" placeholder="后端开发ID">
        <textarea name="test_doc_content" placeholder="同步到已复制腾讯测试文档的内容"></textarea>
        <button class="btn" type="submit">保存更新</button>
    </form>
    <button id="deleteBtn" class="btn danger">删除项目</button>
    <p id="editMessage"></p>
</section>
@endsection

@push('scripts')
<script>window.renderProjectEditPage({{ $projectId }});</script>
@endpush
