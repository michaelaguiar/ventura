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
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased min-h-screen flex flex-col">
        <header class="flex justify-center pt-[70px]">
            <div class="max-w-screen-xl w-full flex items-center mb-6 px-4">
                <img src="{{ asset('images/logo.png') }}" alt="Ventura Logo" class="">
            </div>
        </header>

        <main class="flex">
            {{ $slot }}
        </main>

        <footer class="flex flex-col justify-center items-center  bg-white/90 backdrop-blur-sm border-t border-gray-200/50">
            <div class="max-w-screen-xl w-full px-8 py-6 flex items-center justify-between px-4">
                <div class="flex items-center">
                    <div>
                        <img src="{{ asset('images/logo_footer.png') }}" alt="Ventura Logo" class="">

                        <p class="text-sm text-gray-600 max-w-md pt-5">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                        <p class="text-xs text-gray-400 pt-5">&copy; 2025 Ventura Community Management, LLC. All rights reserved.</p>
                    </div>
                </div>
                <div class="flex items-center space-x-6 text-sm text-blue-600">
                    <a href="#" class="hover:text-blue-800 font-medium text-[#03a1bf]">Privacy Policy</a>
                    <span class="text-gray-400">|</span>
                    <a href="#" class="hover:text-blue-800 font-medium text-[#03a1bf]">Terms of Use</a>
                </div>
            </div>
        </footer>
    </body>
</html>
