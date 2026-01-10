<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased bg-white">
    <div class="min-h-screen flex">
        <!-- Left Side - Visual -->
        <div class="hidden lg:flex lg:w-1/2 relative bg-indigo-900 overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-br from-indigo-600 via-purple-700 to-pink-600 opacity-90"></div>

            <!-- Decorative Shapes -->
            <div
                class="absolute top-0 right-0 -mr-20 -mt-20 w-96 h-96 rounded-full bg-purple-500 blur-3xl opacity-30 animate-pulse">
            </div>
            <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-80 h-80 rounded-full bg-indigo-400 blur-3xl opacity-30 animate-pulse"
                style="animation-delay: 1s;"></div>

            <div class="relative z-10 w-full flex flex-col justify-center px-12 text-white">
                <div class="mb-8">
                    <div
                        class="w-12 h-12 bg-white/10 backdrop-blur-lg rounded-xl flex items-center justify-center border border-white/20 mb-6">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <h2 class="text-4xl font-bold mb-4 leading-tight">Platform Mahasiswa <br>Masa Depan</h2>
                    <p class="text-indigo-100 text-lg max-w-md">Bergabunglah dengan ribuan mahasiswa lainnya untuk
                        menemukan event, organisasi, dan kesempatan terbaik di kampus.</p>
                </div>

                <div class="grid grid-cols-2 gap-4 mt-8">
                    <div
                        class="bg-white/5 backdrop-blur-sm p-4 rounded-xl border border-white/10 hover:bg-white/10 transition">
                        <div class="text-2xl font-bold mb-1">100+</div>
                        <div class="text-xs text-indigo-200 uppercase tracking-wider">Active Events</div>
                    </div>
                    <div
                        class="bg-white/5 backdrop-blur-sm p-4 rounded-xl border border-white/10 hover:bg-white/10 transition">
                        <div class="text-2xl font-bold mb-1">50+</div>
                        <div class="text-xs text-indigo-200 uppercase tracking-wider">Organizations</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side - Form -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-8 bg-white dark:bg-gray-900">
            <div class="w-full max-w-md space-y-8">
                {{ $slot }}
            </div>
        </div>
    </div>
</body>

</html>