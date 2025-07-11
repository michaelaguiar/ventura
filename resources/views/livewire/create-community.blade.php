<div class="flex justify-center w-full bg-gradient-to-t from-[#27aac4] to-white mt-[-50px]">
    <!-- Main Content Container -->
    <div class="max-w-screen-xl w-full">

        <!-- Desktop Layout - Side by Side -->
        <div class="lg:flex relative min-h-[750px]">
            <!-- Left Side - Form Section -->
            <div class="flex flex-col justify-center px-8 pt-12 lg:pt-24 pb-6 lg:w-1/2">
                <!-- Single Form for Both Desktop and Mobile -->
                <form wire:submit="next" class="space-y-2 max-w-sm mx-auto lg:mx-0">
                    <!-- Community Name -->
                    <div>
                        <label for="communityName" class="block text-xs font-bold text-gray-700 mb-2 tracking-wider">
                            COMMUNITY NAME <span class="text-red-500">*</span>
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
                            COMMUNITY ADDRESS <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <x-alias::address-input
                                wire:model="formData.address"
                                placeholder="Community Address"
                                required
                                class="w-full px-4 py-3 pl-12 border border-[#72d0df] rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-gray-900 bg-white"
                            />
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
                            COMMUNITY CONTACT NAME <span class="text-red-500">*</span>
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
                            PHONE NUMBER <span class="text-red-500">*</span>
                        </label>
                        <x-alias::phone-input
                            wire:model="formData.phone"
                            placeholder="Phone Number"
                            required
                            class="w-full px-4 py-3 border border-[#72d0df] rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-gray-900 bg-white"
                        />
                        <x-input-error for="formData.phone" />
                    </div>

                    <!-- Email Address -->
                    <div>
                        <label for="emailAddress" class="block text-xs font-bold text-gray-700 mb-2 tracking-wider">
                            EMAIL ADDRESS <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="email"
                            id="emailAddress"
                            wire:model="formData.email"
                            placeholder="Email Address"
                            class="w-full px-4 py-3 border border-[#72d0df] rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-gray-900 bg-white"
                            required
                        >
                        <x-input-error for="formData.email" />
                    </div>

                    <!-- Upload Logo -->
                    <div x-data="{ fileName: 'No file selected.', fileSelected: false }">
                        <label class="block text-xs font-bold text-gray-700 mb-2 tracking-wider">
                            UPLOAD A LOGO <span class="text-red-500">*</span>
                        </label>
                        <div>
                            <input
                                type="file"
                                wire:model="logo"
                                accept="image/*"
                                class="hidden"
                                id="logo-upload"
                                x-ref="fileInput"
                                @change="fileName = $event.target.files.length > 0 ? $event.target.files[0].name : 'No file selected.'; fileSelected = $event.target.files.length > 0"
                            >
                            <div class="p-1 border border-[#72d0df] rounded-lg bg-white cursor-pointer hover:bg-gray-50" @click="$refs.fileInput.click()">
                                <div class="flex items-center justify-between">
                                    <span class="text-gray-500 px-4" x-text="fileName"></span>
                                    <button
                                        type="button"
                                        class="px-8 py-2.5 bg-[#03a1bf] text-white rounded cursor-pointer hover:bg-[#027a8f] focus:outline-none focus:ring-2 focus:ring-blue-500 font-medium"
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
                            class="bg-[#03a1bf] text-white px-8 py-3 rounded-lg cursor-pointer hover:bg-[#027a8f] focus:outline-none focus:ring-2 focus:ring-blue-500 flex items-center font-medium disabled:opacity-50 disabled:cursor-not-allowed disabled:hover:bg-[#03a1bf]"
                            wire:loading.attr="disabled"
                            wire:target="logo"
                        >
                            <span wire:loading.remove wire:target="logo">Next</span>
                            <span wire:loading wire:target="logo">Uploading...</span>
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" wire:loading.remove wire:target="logo">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                            <svg class="animate-spin w-5 h-5 ml-2" fill="none" viewBox="0 0 24 24" wire:loading wire:target="logo">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                        </button>
                    </div>

                    <!-- Disclaimer -->
                    <p class="text-md text-white pt-2">
                        All settings selected during app setup can be changed later at any time.
                    </p>
                </form>
            </div>

            <!-- Right Side - Image Section (Desktop Only) -->
            <div class="hidden lg:block lg:w-1/2 relative">
                <div class="absolute inset-0" style="background-image: url('{{ asset('images/community-hand.png') }}'); background-size: 796px 742px; background-repeat: no-repeat; background-position: bottom right;">
                </div>
            </div>
        </div>

        <!-- Mobile Image Section -->
        <div class="lg:hidden flex justify-center items-end flex-grow px-4">
            <div class="relative">
                <img
                    src="{{ asset('images/community-hand.png') }}"
                    alt="Community Setup"
                    class="w-full h-full object-contain object-bottom"
                >
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('address_updated', (address) => {
           @this.updateAddress(address.detail);
        });
    </script>
</div>
