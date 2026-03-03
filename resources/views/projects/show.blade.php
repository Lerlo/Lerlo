@extends('layouts.app', ['title' => '项目详情'])

@section('content')
<section class="card">
    <h2>项目详情 #{{ $projectId }}</h2>
    <pre id="projectDetail"></pre>
    @if(($permissions['projects.update'] ?? false) === true)
        <a class="btn" href="{{ route('projects.edit', ['project' => $projectId]) }}">编辑项目</a>
    @endif
</section>
@endsection

@push('scripts')
<script>window.renderProjectShowPage({{ $projectId }});</script>
@endpush
