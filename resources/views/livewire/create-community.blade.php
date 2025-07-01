<div class="flex justify-center w-full bg-gradient-to-t from-[#27aac4] to-white mt-[-50px]">
    <!-- Main Content Container -->
    <div class="max-w-screen-xl w-full relative" style="background-image: url('{{ asset('images/community-hand.png') }}'); background-size: 796px 742px; background-repeat: no-repeat; background-position: bottom right;">

        <!-- Left Side - Form Section -->
        <div class="flex flex-col justify-center px-8 pt-24 pb-6">
            <!-- Form -->
            <form wire:submit="next" class="space-y-2 max-w-sm">
                <!-- Community Name -->
                <div>
                    <label for="communityName" class="block text-xs font-bold text-gray-700 mb-2 tracking-wider">
                        COMMUNITY NAME
                    </label>
                    <input
                        type="text"
                        id="communityName"
                        wire:model="formData.name"
                        placeholder="Community Name"
                        class="w-full px-4 py-3 border border-[#72d0df] rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-gray-900 bg-white"
                        required
                    >
                    <x-input-error for="formData.name" />
                </div>

                <!-- Community Address -->
                <div>
                    <label for="communityAddress" class="block text-xs font-bold text-gray-700 mb-2 tracking-wider">
                        COMMUNITY ADDRESS
                    </label>
                    <div class="relative">
                        <input
                            type="text"
                            id="communityAddress"
                            wire:model="formData.address"
                            placeholder="Community Address"
                            class="w-full px-4 py-3 pl-12 border border-[#72d0df] rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-gray-900 bg-white"
                            required
                        >
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-[#03a1bf]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <x-input-error for="formData.address" />
                </div>

                <!-- Community Contact Name -->
                <div>
                    <label for="communityContactName" class="block text-xs font-bold text-gray-700 mb-2 tracking-wider">
                        COMMUNITY CONTACT NAME
                    </label>
                    <input
                        type="text"
                        id="communityContactName"
                        wire:model="formData.contactName"
                        placeholder="Community Contact Name"
                        class="w-full px-4 py-3 border border-[#72d0df] rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-gray-900 bg-white"
                        required
                    >
                        <x-input-error for="formData.contactName" />
                </div>

                <!-- Phone Number -->
                <div>
                    <label for="phoneNumber" class="block text-xs font-bold text-gray-700 mb-2 tracking-wider">
                        PHONE NUMBER
                    </label>
                    <input
                        type="tel"
                        id="phoneNumber"
                        wire:model="formData.phone"
                        placeholder="Phone Number"
                        class="w-full px-4 py-3 border border-[#72d0df] rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-gray-900 bg-white"
                        required
                    >
                        <x-input-error for="formData.phone" />
                </div>

                <!-- Email Address -->
                <div>
                    <label for="formData.contactEmail" class="block text-xs font-bold text-gray-700 mb-2 tracking-wider">
                        EMAIL ADDRESS
                    </label>
                    <input
                        type="email"
                        id="emailAddress"
                        wire:model="formData.emailAddress"
                        placeholder="Email Address"
                        class="w-full px-4 py-3 border border-[#72d0df] rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-gray-900 bg-white"
                        required
                    >
                        <x-input-error for="formData.emailAddress" />
                </div>

                <!-- Upload Logo -->
                <div x-data="{ fileName: 'No file selected.' }">
                    <label class="block text-xs font-bold text-gray-700 mb-2 tracking-wider">
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
                        <div class="p-1 border border-[#72d0df] rounded-lg bg-white cursor-pointer hover:bg-gray-50" @click="$refs.fileInput.click()">
                            <div class="flex items-center justify-between ">
                                <span class="text-gray-500 px-4" x-text="fileName"></span>
                                <button
                                    type="button"
                                    class="px-8 py-2.5 bg-[#03a1bf] text-white rounded hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 font-medium"
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
                        class="bg-[#03a1bf] text-white px-8 py-3 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 flex items-center font-medium"
                    >
                        Next
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </button>
                </div>

                <!-- Disclaimer -->
                <p class="text-md text-white pt-2">
                    All settings selected during app setup can be changed later at any time.
                </p>
            </form>
        </div>

        <!-- Right Side - Phone Mockup -->


</div>
