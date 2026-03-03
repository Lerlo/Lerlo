<!doctype html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? '项目管理' }}</title>
    <link rel="stylesheet" href="/css/project-pages.css">
</head>
<body>
<header class="topbar">
    <h1>公司项目管理平台</h1>
    <nav>
        <a href="{{ route('projects.index') }}">项目列表</a>
        <a href="{{ route('projects.create') }}">新建立项</a>
    </nav>
</header>
<main class="container">
    @yield('content')
</main>
<script>
    window.projectApp = {
        apiBase: '/api/projects',
        token: localStorage.getItem('sanctum_token') || '',
    };
</script>
<script src="/js/project-pages.js"></script>
@stack('scripts')
</body>
</html>
