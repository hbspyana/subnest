<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Subnest</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.15.1/dist/cdn.min.js"></script>
    @endif
</head>

<body class="font-sans antialiased">

    <div class="min-h-screen bg-slate-950 flex">

        <!-- Sidebar -->
        @include('layouts.app_navigation')

        <!-- Main Content -->
        <div class="flex-1 min-w-0">

            @isset($header)
                <header class="border-b border-slate-800 px-8 py-6">
                    {{ $header }}
                </header>
            @endisset

            <main class="p-8 text-slate-100">
                {{ $slot }}
            </main>

        </div>

    </div>

</body>
</html>