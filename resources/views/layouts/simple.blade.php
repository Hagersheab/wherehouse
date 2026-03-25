<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name'))</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* تنسيقات بسيطة للصفحات الخاصة بنا */
        .page { max-width: 900px; margin: 0 auto; padding: 1.5rem; }
        .nav { background: #1f2937; color: #fff; padding: 0.75rem 1rem; }
        .nav a { color: #e5e7eb; margin-right: 1rem; text-decoration: none; }
        .nav a:hover { color: #fff; }
        .footer { background: #f3f4f6; padding: 0.75rem 1rem; margin-top: 2rem; text-align: center; font-size: 0.875rem; color: #6b7280; }
        .footer a { color: #4b5563; margin: 0 0.5rem; }
        .card { background: #fff; border: 1px solid #e5e7eb; border-radius: 0.5rem; padding: 1.5rem; margin-bottom: 1rem; }
        .btn { display: inline-block; padding: 0.5rem 1rem; border-radius: 0.375rem; text-decoration: none; font-size: 0.875rem; border: none; cursor: pointer; }
        .btn-primary { background: #1f2937; color: #fff; }
        .btn-primary:hover { background: #374151; }
        .btn-secondary { background: #fff; color: #374151; border: 1px solid #d1d5db; }
        .btn-secondary:hover { background: #f9fafb; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 0.5rem 0.75rem; text-align: left; border-bottom: 1px solid #e5e7eb; }
        th { background: #f9fafb; font-weight: 600; }
        .form-group { margin-bottom: 1rem; }
        .form-group label { display: block; margin-bottom: 0.25rem; font-weight: 500; }
        .form-group input, .form-group select, .form-group textarea { width: 100%; padding: 0.5rem; border: 1px solid #d1d5db; border-radius: 0.375rem; }
        .form-group textarea { min-height: 80px; }
        .error { color: #dc2626; font-size: 0.875rem; margin-top: 0.25rem; }
        .success { background: #dcfce7; color: #166534; padding: 0.75rem; border-radius: 0.375rem; margin-bottom: 1rem; }
        .alert-error { background: #fee2e2; color: #991b1b; padding: 0.75rem; border-radius: 0.375rem; margin-bottom: 1rem; }
        .page-title { font-size: 1.25rem; font-weight: 600; margin-bottom: 1rem; }
        .link { color: #2563eb; text-decoration: none; }
        .link:hover { text-decoration: underline; }
    </style>
</head>
<body class="bg-gray-100 min-h-screen">
    {{-- شريط التنقل البسيط --}}
    <nav class="nav">
        <a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a>
        <a href="{{ route('categories.index') }}">{{ __('Categories') }}</a>
        <a href="{{ route('items.index') }}">{{ __('Items') }}</a>
        <a href="{{ route('warehouse.index') }}">{{ __('Warehouse') }}</a>
        <a href="{{ route('imports.index') }}">{{ __('Imports') }}</a>
        <a href="{{ route('exports.index') }}">{{ __('Exports') }}</a>
        <a href="{{ route('departments.index') }}">{{ __('Departments') }}</a>
        <a href="{{ route('profile.edit') }}">{{ __('Profile') }}</a>
        <form action="{{ route('logout') }}" method="POST" style="display:inline;">
            @csrf
            <button type="submit" style="background:none;border:none;color:#e5e7eb;cursor:pointer;font-size:1rem;">{{ __('Logout') }}</button>
        </form>
    </nav>

    <main class="page">
        @if (session('success'))
            <div class="success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert-error">{{ session('error') }}</div>
        @endif
        @yield('content')
    </main>

    <footer class="footer">
        &copy; {{ date('Y') }} {{ config('app.name') }}
        <a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a>
        <a href="{{ route('categories.index') }}">{{ __('Categories') }}</a>
        <a href="{{ route('items.index') }}">{{ __('Items') }}</a>
    </footer>
</body>
</html>
