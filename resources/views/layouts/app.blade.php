<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js','resources/js/functions.js'])


</head>

<body class="font-sans antialiased dark:bg-black dark:text-white/50">
    <div class="min-h-screen bg-gray-100 text-black dark:bg-black dark:text-white/50">
        <div class="grid grid-cols-[288px_minmax(900px,_1fr)] relative">

            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="pb-10">

                <!-- Banniere noir -->
                <div class="bg-[#2a2e32] min-h-24 relative">
                    <div class="text-white text-center flex justify-center items-center min-h-24">

                        <a href="{{ Route('app.index') }}" class="text-2xl font-bold">
                            <i class="bi bi-book-fill text-4xl text-[#596643] align-middle mr-3"></i>
                            <span>Documents</span>
                        </a>
                    </div>
                </div>

                @yield('content')
            </main>
        </div>
    </div>

        <footer class="py-16 text-center text-sm text-black dark:text-white/70">
            Powered by Vickson Ahiwa
        </footer>

</body>

</html>
