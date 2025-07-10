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
    <body class="font-sans antialiased min-h-screen flex flex-col" x-data="{ mobileMenuOpen: false }">
        <header class="flex justify-center pt-[70px] z-10 relative">
            <a href="/" class="max-w-screen-xl w-full flex items-center mb-6 px-4">
                <img src="{{ asset('images/logo.png') }}" alt="Ventura Logo" class="">
            </a>

            <!-- Hamburger Menu Button (Mobile Only) -->
            <button
                @click="mobileMenuOpen = !mobileMenuOpen"
                class="lg:hidden fixed top-6 right-6 z-50 bg-[#03a1bf] text-white p-3 rounded-lg shadow-lg hover:bg-[#027a8f] transition-colors"
            >
                <svg x-show="!mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
                <svg x-show="mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>

            <!-- Mobile Navigation Menu -->
            <div
                x-show="mobileMenuOpen"
                @click.away="mobileMenuOpen = false"
                class="lg:hidden fixed inset-0 z-40 bg-black bg-opacity-50"
            >
                <div class="fixed top-0 right-0 h-full w-80 bg-white shadow-xl">
                    <div class="p-6 pt-20">
                        <h3 class="text-lg font-semibold text-gray-800 mb-6">Navigation</h3>
                        <nav class="space-y-3">
                            <a href="/" class="flex items-center space-x-3 p-3 bg-[#72d0df] text-white rounded-lg hover:bg-[#5bc5d6] transition-colors" @click="mobileMenuOpen = false">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                </svg>
                                <span class="font-medium">Welcome</span>
                            </a>
                            @php
                                $communityId = request()->segment(2);
                            @endphp
                            @if($communityId)


                                <a href="/community/{{ $communityId }}/activities" class="flex items-center space-x-3 p-3 bg-[#72d0df] text-white rounded-lg hover:bg-[#5bc5d6] transition-colors" @click="mobileMenuOpen = false">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    <span class="font-medium">Activities</span>
                                </a>
                                <a href="/community/{{ $communityId }}/vendors" class="flex items-center space-x-3 p-3 bg-[#72d0df] text-white rounded-lg hover:bg-[#5bc5d6] transition-colors" @click="mobileMenuOpen = false">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    <span class="font-medium">Vendors</span>
                                </a>
                                <a href="/community/{{ $communityId }}/maintenance" class="flex items-center space-x-3 p-3 bg-[#72d0df] text-white rounded-lg hover:bg-[#5bc5d6] transition-colors" @click="mobileMenuOpen = false">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path>
                                    </svg>
                                    <span class="font-medium">Maintenance</span>
                                </a>
                                <a href="/community/{{ $communityId }}/amenities" class="flex items-center space-x-3 p-3 bg-[#72d0df] text-white rounded-lg hover:bg-[#5bc5d6] transition-colors" @click="mobileMenuOpen = false">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                    </svg>
                                    <span class="font-medium">Amenities</span>
                                </a>
                            @endif
                        </nav>
                    </div>
                </div>
            </div>
        </header>

        <main class="flex">
            {{ $slot }}
        </main>

        <footer class="flex flex-col justify-center items-center  bg-white/90 backdrop-blur-sm border-t border-gray-200/50">
            <div class="max-w-screen-xl w-full px-8 py-6 px-4">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                    <div class="flex items-center">
                        <div>
                            <img src="{{ asset('images/logo_footer.png') }}" alt="Ventura Logo" class="">

                            <p class="text-sm text-gray-600 max-w-md pt-5">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                            <p class="text-xs text-gray-400 pt-5">&copy; 2025 Ventura Community Management, LLC. All rights reserved.</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-2 text-sm text-blue-600 mt-4 md:mt-0">
                        <a href="#" class="hover:text-blue-800 font-medium text-[#03a1bf]">Privacy Policy</a>
                        <span class="text-gray-400">|</span>
                        <a href="#" class="hover:text-blue-800 font-medium text-[#03a1bf]">Terms of Use</a>
                    </div>
                </div>
            </div>
        </footer>

        @stack('scripts')
    </body>
</html>
