@extends('layouts.app', ['title' => '项目列表'])

@section('content')
<section class="card">
    <h2>项目列表</h2>
    <div class="filters">
        <input id="keyword" placeholder="关键词（项目名/描述）">
        <select id="stage">
            <option value="">全部阶段</option>
            @foreach($stages as $stage)
                <option value="{{ $stage }}">{{ $stage }}</option>
            @endforeach
        </select>
        <select id="overall_status">
            <option value="">全部状态</option>
            @foreach($statuses as $status)
                <option value="{{ $status }}">{{ $status }}</option>
            @endforeach
        </select>
        <button id="searchBtn" class="btn">查询</button>
    </div>

    <table>
        <thead>
        <tr>
            <th>ID</th><th>项目名</th><th>阶段</th><th>综合状态</th><th>项目经理</th><th>操作</th>
        </tr>
        </thead>
        <tbody id="projectTableBody"></tbody>
    </table>
    <p id="listMessage"></p>
</section>
@endsection

@push('scripts')
<script>window.renderProjectListPage({ canUpdate: @json($permissions['projects.update'] ?? false) });</script>
@endpush
