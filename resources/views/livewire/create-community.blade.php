<div class="min-h-screen w-full bg-gradient-to-t from-blue-800 to-white relative">
    <!-- Main Content Container -->
    <div class="flex w-full h-screen">
        <!-- Left Side - Form Section -->
        <div class="w-1/2 flex flex-col justify-center px-16 py-8">
            <!-- Header -->
            <div class="mb-8">
                <!-- Logo and Title -->
                <div class="flex items-center mb-6">
                    <div class="w-12 h-12 bg-blue-600 rounded-full flex items-center justify-center mr-4">
                        <svg class="w-7 h-7 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">Ventura</h1>
                        <p class="text-blue-600 font-medium">Community Management</p>
                    </div>
                </div>


            </div>

            <!-- Form -->
            <form wire:submit="next" class="space-y-6 max-w-sm">
                <!-- Community Name -->
                <div>
                    <label for="communityName" class="block text-sm font-bold text-gray-700 mb-2 tracking-wider">
                        COMMUNITY NAME
                    </label>
                    <input
                        type="text"
                        id="communityName"
                        wire:model="formData.name"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-gray-900 bg-white"
                        required
                    >
                    <x-input-error for="formData.name" />
                </div>

                <!-- Community Address -->
                <div>
                    <label for="communityAddress" class="block text-sm font-bold text-gray-700 mb-2 tracking-wider">
                        COMMUNITY ADDRESS
                    </label>
                    <div class="relative">
                        <input
                            type="text"
                            id="communityAddress"
                            wire:model="formData.address"
                            class="w-full px-4 py-3 pl-12 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-gray-900 bg-white"
                            required
                        >
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <x-input-error for="formData.address" />
                </div>

                <!-- Community Contact Name -->
                <div>
                    <label for="communityContactName" class="block text-sm font-bold text-gray-700 mb-2 tracking-wider">
                        COMMUNITY CONTACT NAME
                    </label>
                    <input
                        type="text"
                        id="communityContactName"
                        wire:model="formData.contactName"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-gray-900 bg-white"
                        required
                    >
                        <x-input-error for="formData.contactName" />
                </div>

                <!-- Phone Number -->
                <div>
                    <label for="phoneNumber" class="block text-sm font-bold text-gray-700 mb-2 tracking-wider">
                        PHONE NUMBER
                    </label>
                    <input
                        type="tel"
                        id="phoneNumber"
                        wire:model="formData.phone"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-gray-900 bg-white"
                        required
                    >
                        <x-input-error for="formData.phone" />
                </div>

                <!-- Email Address -->
                <div>
                    <label for="formData.contactEmail" class="block text-sm font-bold text-gray-700 mb-2 tracking-wider">
                        EMAIL ADDRESS
                    </label>
                    <input
                        type="email"
                        id="emailAddress"
                        wire:model="formData.emailAddress"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-gray-900 bg-white"
                        required
                    >
                        <x-input-error for="formData.contactEmail" />
                </div>

                <!-- Upload Logo -->
                <div x-data="{ fileName: 'No file selected.' }">
                    <label class="block text-sm font-bold text-gray-700 mb-2 tracking-wider">
                        UPLOAD A LOGO
                    </label>
                    <div>
                        <input
                            type="file"
                            wire:model="logo"
                            accept="image/*"
                            class="hidden"
                            id="logo-upload"
                            x-ref="fileInput"
                            @change="fileName = $event.target.files.length > 0 ? $event.target.files[0].name : 'No file selected.'"
                        >
                        <div class="p-1 border border-gray-300 rounded-lg bg-white cursor-pointer hover:bg-gray-50" @click="$refs.fileInput.click()">
                            <div class="flex items-center justify-between px-4 py-3">
                                <span class="text-gray-500" x-text="fileName"></span>
                                <button
                                    type="button"
                                    class="px-8 py-2.5 bg-blue-600 text-white rounded hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 font-medium"
                                >
                                    Browse
                                </button>
                            </div>
                        </div>
                    </div>

                    <x-input-error for="logo" />
                </div>

                <!-- Next Button -->
                <div class="pt-4">
                    <button
                        type="submit"
                        class="bg-blue-600 text-white px-8 py-3 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 flex items-center font-medium"
                    >
                        Next
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </button>
                </div>

                <!-- Disclaimer -->
                <p class="text-sm text-gray-600 pt-2">
                    All settings selected during app setup can be changed later at any time.
                </p>
            </form>
        </div>

        <!-- Right Side - Phone Mockup -->
        <div class="w-1/2 flex items-center justify-center relative">
            <!-- Decorative Background Elements -->
            <div class="absolute top-20 right-20 w-32 h-32 bg-white/20 rounded-full blur-xl"></div>
            <div class="absolute bottom-40 right-32 w-24 h-24 bg-blue-400/30 rounded-full blur-lg"></div>

            <!-- Phone Container -->
            <div class="relative z-10">
                <!-- Phone Frame -->
                <div class="w-80 h-[600px] bg-black rounded-[3rem] p-2 shadow-2xl">
                    <div class="w-full h-full bg-white rounded-[2.5rem] overflow-hidden relative">
                        <!-- Status Bar -->
                        <div class="h-6 bg-gray-100 flex items-center justify-center">
                            <div class="w-2 h-2 bg-gray-400 rounded-full"></div>
                        </div>

                        <!-- Screen Content -->
                        <div class="flex-1 bg-gradient-to-b from-blue-50 to-white p-4">
                            <!-- App Header -->
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center">
                                    <div class="w-6 h-6 bg-blue-600 rounded-full flex items-center justify-center mr-2">
                                        <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                                        </svg>
                                    </div>
                                    <span class="text-xs font-semibold text-gray-800">Desert Vista RV Resort</span>
                                </div>
                                <div class="flex space-x-1">
                                    <div class="w-1 h-1 bg-gray-400 rounded-full"></div>
                                    <div class="w-1 h-1 bg-gray-400 rounded-full"></div>
                                    <div class="w-1 h-1 bg-gray-400 rounded-full"></div>
                                </div>
                            </div>

                            <!-- Community Image Placeholder -->
                            <div class="mb-4 h-20 bg-gray-200 rounded-lg flex items-center justify-center">
                                <span class="text-xs text-gray-500">Community Image</span>
                            </div>

                            <!-- Community Logo -->
                            <div class="flex justify-center mb-4">
                                <div class="w-16 h-16 bg-yellow-400 rounded-full flex items-center justify-center border-4 border-white shadow-lg">
                                    <svg class="w-8 h-8 text-yellow-700" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                                    </svg>
                                </div>
                            </div>

                            <!-- App Grid -->
                            <div class="grid grid-cols-3 gap-3">
                                <!-- Welcome -->
                                <div class="bg-blue-500 rounded-xl p-3 text-center">
                                    <div class="text-white mb-1">
                                        <svg class="w-6 h-6 mx-auto" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
                                        </svg>
                                    </div>
                                    <span class="text-xs text-white font-bold">WELCOME</span>
                                </div>

                                <!-- Activities -->
                                <div class="bg-blue-500 rounded-xl p-3 text-center">
                                    <div class="text-white mb-1">
                                        <svg class="w-6 h-6 mx-auto" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-5 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z"/>
                                        </svg>
                                    </div>
                                    <span class="text-xs text-white font-bold">ACTIVITIES</span>
                                </div>

                                <!-- Emergency -->
                                <div class="bg-blue-500 rounded-xl p-3 text-center">
                                    <div class="text-white mb-1">
                                        <svg class="w-6 h-6 mx-auto" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                                        </svg>
                                    </div>
                                    <span class="text-xs text-white font-bold">EMERGENCY</span>
                                </div>

                                <!-- Reservations -->
                                <div class="bg-blue-500 rounded-xl p-3 text-center">
                                    <div class="text-white mb-1">
                                        <svg class="w-6 h-6 mx-auto" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.94-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-.8 3.97-2.1 5.39z"/>
                                        </svg>
                                    </div>
                                    <span class="text-xs text-white font-bold">RESERVATIONS</span>
                                </div>

                                <!-- Map -->
                                <div class="bg-blue-500 rounded-xl p-3 text-center">
                                    <div class="text-white mb-1">
                                        <svg class="w-6 h-6 mx-auto" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                                        </svg>
                                    </div>
                                    <span class="text-xs text-white font-bold">MAP</span>
                                </div>

                                <!-- Messages -->
                                <div class="bg-blue-500 rounded-xl p-3 text-center">
                                    <div class="text-white mb-1">
                                        <svg class="w-6 h-6 mx-auto" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
                                        </svg>
                                    </div>
                                    <span class="text-xs text-white font-bold">MESSAGES</span>
                                </div>

                                <!-- Second Row - Reservations -->
                                <div class="bg-blue-500 rounded-xl p-3 text-center">
                                    <div class="text-white mb-1">
                                        <svg class="w-6 h-6 mx-auto" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.94-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-.8 3.97-2.1 5.39z"/>
                                        </svg>
                                    </div>
                                    <span class="text-xs text-white font-bold">RESERVATIONS</span>
                                </div>

                                <!-- Map -->
                                <div class="bg-blue-500 rounded-xl p-3 text-center">
                                    <div class="text-white mb-1">
                                        <svg class="w-6 h-6 mx-auto" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                                        </svg>
                                    </div>
                                    <span class="text-xs text-white font-bold">MAP</span>
                                </div>

                                <!-- Messages -->
                                <div class="bg-blue-500 rounded-xl p-3 text-center">
                                    <div class="text-white mb-1">
                                        <svg class="w-6 h-6 mx-auto" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
                                        </svg>
                                    </div>
                                    <span class="text-xs text-white font-bold">MESSAGES</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="absolute bottom-0 left-0 w-full bg-white/90 backdrop-blur-sm border-t border-gray-200/50">
        <div class="w-full px-8 py-6 flex items-center justify-between">
            <div class="flex items-center">
                <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center mr-4">
                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="font-bold text-gray-900 text-lg">Ventura</h3>
                    <p class="text-sm text-gray-600 max-w-md">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                </div>
            </div>
            <div class="flex items-center space-x-6 text-sm text-blue-600">
                <a href="#" class="hover:text-blue-800 font-medium">Privacy Policy</a>
                <span class="text-gray-400">|</span>
                <a href="#" class="hover:text-blue-800 font-medium">Terms of Use</a>
            </div>
        </div>
        <div class="text-center text-xs text-gray-500 pb-3">
            © 2025 Ventura Community Management, LLC. All rights reserved.
        </div>
    </div>


</div>
