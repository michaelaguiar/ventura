<div class="flex justify-center w-full bg-gradient-to-t from-[#27aac4] to-white mt-[-50px]">
    <!-- Main Content Container -->
    <div class="max-w-screen-xl w-full">

        <!-- Desktop Layout - Side by Side -->
        <div class="lg:flex relative min-h-[750px]" style="">
            <!-- Background Hand Image - Desktop Only -->
            <div class="hidden lg:block absolute w-[630px] h-[669px] bottom-0 left-[300px] lg:left-[35%]" style="background-image: url('{{ asset('images/hand_sub.png') }}'); background-size: 630px 669px; background-repeat: no-repeat; background-position: right bottom; z-index: 1;">
                <div class="w-[239px] h-[300px] flex flex-col ml-[63px] mt-[36px]">
                    <div class="flex-1 text-center">
                        <h3 class="font-bold text-[11px] text-gray-800">{{ $community->name ?? 'Desert Vista RV Resort' }}</h3>
                        <p class="text-[9px] text-gray-600">{{ $community->address ?? 'Community Address' }}</p>
                    </div>

                    <!-- Phone Header with Community Info -->
                    <div class="mt-[75px]">
                        <div class="flex items-center justify-center">
                            @if($community && $community->logo_path)
                                <img src="{{ Storage::url($community->logo_path) }}" alt="{{ $community->name ?? 'Community' }} Logo" class="w-26 h-26 rounded-full object-contain bg-[#333]">
                            @else
                                <div class="w-26 h-26 bg-[#03a1bf] rounded-full flex items-center justify-center">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                    </svg>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Phone Navigation Grid -->
                    <div class="bg-white flex-1 px-6 py-4 rounded-b-3xl">
                        <div class="grid grid-cols-3 gap-3 h-full">
                            <!-- Row 1 -->
                            <div class="flex flex-col items-center">
                                <a href="/" class="bg-[#72d0df] rounded-lg flex items-center justify-center p-3 hover:bg-[#5bc5d6] transition-colors w-full h-12">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                    </svg>
                                </a>
                                <span class="text-[9px] text-gray-700 font-medium mt-1">WELCOME</span>
                            </div>

                            <div class="flex flex-col items-center">
                                <a href="/community/{{ $community->id }}/activities" class="bg-[#72d0df] rounded-lg flex items-center justify-center p-3 hover:bg-[#5bc5d6] transition-colors w-full h-12">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </a>
                                <span class="text-[9px] text-gray-700 font-medium mt-1">ACTIVITIES</span>
                            </div>

                            <div class="flex flex-col items-center">
                                <a href="/community/{{ $community->id }}/vendors" class="bg-[#72d0df] rounded-lg flex items-center justify-center p-3 hover:bg-[#5bc5d6] transition-colors w-full h-12">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </a>
                                <span class="text-[9px] text-gray-700 font-medium mt-1">VENDORS</span>
                            </div>

                            <!-- Row 2 -->
                            <div class="flex flex-col items-center">
                                <a href="/community/{{ $community->id }}/maintenance" class="bg-[#72d0df] rounded-lg flex items-center justify-center p-3 hover:bg-[#5bc5d6] transition-colors w-full h-12">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path>
                                    </svg>
                                </a>
                                <span class="text-[9px] text-gray-700 font-medium mt-1">MAINTENANCE</span>
                            </div>

                            <div class="flex flex-col items-center">
                                <a href="/community/{{ $community->id }}/amenities" class="bg-[#72d0df] rounded-lg flex items-center justify-center p-3 hover:bg-[#5bc5d6] transition-colors w-full h-12">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                    </svg>
                                </a>
                                <span class="text-[9px] text-gray-700 font-medium mt-1">AMENITIES</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Left Side - Form Section -->
            <div class="flex flex-col px-8 pt-12 lg:pt-24 pb-6 z-2 max-w-sm mx-auto lg:mx-0 min-w-[450px]">
                <h1 class="text-2xl font-bold text-gray-800 mb-8">Add a Vendor</h1>

                @if (session()->has('message'))
                    <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                        {{ session('message') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @error('general')
                    <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                        {{ $message }}
                    </div>
                @enderror

                <!-- Form -->
                <form wire:submit="addVendor" class="space-y-2">
                    <!-- Vendor Name -->
                    <div>
                        <label for="vendorName" class="block text-xs font-bold text-gray-700 mb-2 tracking-wider">
                            VENDOR NAME <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="text"
                            id="vendorName"
                            wire:model="formData.name"
                            placeholder="Vendor Name"
                            class="w-full px-4 py-3 border border-[#72d0df] rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-gray-900 bg-white"
                            required
                        >
                        <x-input-error for="formData.name" />
                    </div>

                    <!-- Phone Number -->
                    <div>
                        <label for="vendorPhone" class="block text-xs font-bold text-gray-700 mb-2 tracking-wider">
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

                    <!-- Email -->
                    <div>
                        <label for="vendorEmail" class="block text-xs font-bold text-gray-700 mb-2 tracking-wider">
                            EMAIL ADDRESS
                        </label>
                        <input
                            type="email"
                            id="vendorEmail"
                            wire:model="formData.email"
                            placeholder="vendor@example.com"
                            class="w-full px-4 py-3 border border-[#72d0df] rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-gray-900 bg-white"
                        >
                        <x-input-error for="formData.email" />
                    </div>

                    <!-- Website -->
                    <div>
                        <label for="vendorWebsite" class="block text-xs font-bold text-gray-700 mb-2 tracking-wider">
                            WEBSITE
                        </label>
                        <input
                            type="url"
                            id="vendorWebsite"
                            wire:model="formData.website"
                            placeholder="https://www.example.com"
                            class="w-full px-4 py-3 border border-[#72d0df] rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-gray-900 bg-white"
                        >
                        <x-input-error for="formData.website" />
                    </div>

                    <!-- Contact Name -->
                    <div>
                        <label for="vendorContactName" class="block text-xs font-bold text-gray-700 mb-2 tracking-wider">
                            CONTACT NAME
                        </label>
                        <input
                            type="text"
                            id="vendorContactName"
                            wire:model="formData.contact_name"
                            placeholder="John Doe"
                            class="w-full px-4 py-3 border border-[#72d0df] rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-gray-900 bg-white"
                        >
                        <x-input-error for="formData.contact_name" />
                    </div>

                    <!-- Category -->
                    <div>
                        <label for="vendorCategory" class="block text-xs font-bold text-gray-700 mb-2 tracking-wider">
                            CATEGORY <span class="text-red-500">*</span>
                        </label>
                        <select
                            id="vendorCategory"
                            wire:model="formData.category"
                            class="w-full px-4 py-3 border border-[#72d0df] rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-gray-900 bg-white appearance-none"
                            required
                        >
                            <option value="">Select Category</option>
                            <option value="Plumbing">Plumbing</option>
                            <option value="Electrical">Electrical</option>
                            <option value="HVAC">HVAC</option>
                            <option value="Landscaping">Landscaping</option>
                            <option value="Cleaning">Cleaning</option>
                            <option value="Maintenance">Maintenance</option>
                            <option value="Pest Control">Pest Control</option>
                            <option value="Security">Security</option>
                            <option value="Food Service">Food Service</option>
                            <option value="Entertainment">Entertainment</option>
                            <option value="Other">Other</option>
                        </select>
                        <x-input-error for="formData.category" />
                    </div>

                    <!-- Logo Upload -->
                    <div x-data="{ fileName: 'No file selected.', fileSelected: false }" x-init="$wire.on('vendor-added', () => { fileName = 'No file selected.'; fileSelected = false; })">
                        <label class="block text-xs font-bold text-gray-700 mb-2 tracking-wider">
                            VENDOR LOGO
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

                    <!-- Add Vendor Button -->
                    <div class="pt-4">
                        <button
                            type="submit"
                            class="bg-[#03a1bf] text-white px-8 py-3 rounded-lg cursor-pointer hover:bg-[#027a8f] focus:outline-none focus:ring-2 focus:ring-blue-500 flex items-center font-medium disabled:opacity-50 disabled:cursor-not-allowed disabled:hover:bg-[#03a1bf]"
                            wire:loading.attr="disabled"
                            wire:target="logo"
                        >
                            <span wire:loading.remove wire:target="logo">Add Vendor</span>
                            <span wire:loading wire:target="logo">Adding...</span>
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" wire:loading.remove wire:target="logo">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            <svg class="animate-spin w-5 h-5 ml-2" fill="none" viewBox="0 0 24 24" wire:loading wire:target="logo">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Right Side - Vendors List (Desktop) -->
            <div class="hidden lg:block w-[500px] px-8 pt-24 pb-6 max-w-md z-2 ml-auto">
                <div class="flex items-center justify-between mb-8">
                    <h2 class="text-2xl font-bold text-gray-800">Current Vendors</h2>
                </div>

                <div class="grid grid-cols-1 gap-4">
                    @forelse(array_slice($vendors, 0, 6) as $vendor)
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition-all duration-300 cursor-pointer" wire:click="showVendorDetails({{ $vendor['id'] }})">
                            <div class="p-4">
                                <div class="flex items-start space-x-4">
                                    <!-- Logo -->
                                    <div class="flex-shrink-0">
                                        @if($vendor['logo_path'])
                                            <img src="{{ Storage::url($vendor['logo_path']) }}" alt="{{ $vendor['name'] }} Logo" class="w-20 h-20 rounded-lg object-contain bg-gray-50 border border-gray-200">
                                        @else
                                            <div class="w-20 h-20 bg-[#03a1bf] rounded-lg flex items-center justify-center">
                                                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                                </svg>
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Content -->
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-start justify-between">
                                            <div>
                                                <h4 class="font-semibold text-gray-900 text-lg mb-1">{{ $vendor['name'] }}</h4>
                                                @if($vendor['contact_name'])
                                                    <p class="text-sm text-gray-600 mb-2">{{ $vendor['contact_name'] }}</p>
                                                @endif
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-[#03a1bf] text-white">
                                                    {{ $vendor['category'] }}
                                                </span>
                                            </div>
                                        </div>

                                        <!-- Contact Info -->
                                        <div class="mt-3 space-y-2">
                                            <div class="flex items-center text-sm text-gray-600">
                                                <svg class="w-4 h-4 mr-2 text-[#03a1bf]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                                </svg>
                                                {{ $vendor['phone'] }}
                                            </div>

                                            @if($vendor['email'])
                                                <div class="flex items-center text-sm text-gray-600">
                                                    <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                                    </svg>
                                                    <span class="truncate">{{ $vendor['email'] }}</span>
                                                </div>
                                            @endif

                                            @if($vendor['website'])
                                                <div class="flex items-center text-sm text-gray-600">
                                                    <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                    <a href="{{ $vendor['website'] }}" target="_blank" rel="noopener noreferrer" class="truncate hover:text-blue-600 transition-colors">{{ $vendor['website'] }}</a>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-8">
                            <svg class="w-12 h-12 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            <p class="text-gray-500">No vendors added yet</p>
                            <p class="text-sm text-gray-400">Create your first vendor to get started</p>
                        </div>
                    @endforelse
                </div>

                @if(count($vendors) > 6)
                    <div class="text-center mt-4">
                        <button
                            class="bg-[#03a1bf] text-white px-6 py-2 rounded-lg cursor-pointer hover:bg-[#027a8f] focus:outline-none focus:ring-2 focus:ring-blue-500 font-medium"
                            wire:click="openModal"
                        >
                            SHOW MORE
                        </button>
                    </div>
                @endif
            </div>
        </div>

        <!-- Mobile/Tablet Layout - Vendors List -->
        <div class="lg:hidden px-8 pb-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-bold text-gray-800">Current Vendors</h2>
            </div>

            <div class="space-y-4">
                @forelse($vendors as $vendor)
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition-all duration-300 cursor-pointer" wire:click="showVendorDetails({{ $vendor['id'] }})">
                        <div class="p-4">
                            <div class="flex items-start space-x-4">
                                <!-- Logo -->
                                <div class="flex-shrink-0">
                                    @if($vendor['logo_path'])
                                        <img src="{{ Storage::url($vendor['logo_path']) }}" alt="{{ $vendor['name'] }} Logo" class="w-20 h-20 rounded-lg object-contain bg-gray-50 border border-gray-200">
                                    @else
                                        <div class="w-20 h-20 bg-[#03a1bf] rounded-lg flex items-center justify-center">
                                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                            </svg>
                                        </div>
                                    @endif
                                </div>

                                <!-- Content -->
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-start justify-between">
                                        <div>
                                            <h4 class="font-semibold text-gray-900 text-lg mb-1">{{ $vendor['name'] }}</h4>
                                            @if($vendor['contact_name'])
                                                <p class="text-sm text-gray-600 mb-2">{{ $vendor['contact_name'] }}</p>
                                            @endif
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-[#03a1bf] text-white">
                                                {{ $vendor['category'] }}
                                            </span>
                                        </div>
                                    </div>

                                    <!-- Contact Info -->
                                    <div class="mt-3 space-y-2">
                                        <div class="flex items-center text-sm text-gray-600">
                                            <svg class="w-4 h-4 mr-2 text-[#03a1bf]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                            </svg>
                                            {{ $vendor['phone'] }}
                                        </div>

                                        @if($vendor['email'])
                                            <div class="flex items-center text-sm text-gray-600">
                                                <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                                </svg>
                                                <span class="truncate">{{ $vendor['email'] }}</span>
                                            </div>
                                        @endif

                                        @if($vendor['website'])
                                            <div class="flex items-center text-sm text-gray-600">
                                                <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                <a href="{{ $vendor['website'] }}" target="_blank" rel="noopener noreferrer" class="truncate hover:text-blue-600 transition-colors">{{ $vendor['website'] }}</a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-8">
                        <svg class="w-12 h-12 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        <p class="text-gray-500">No vendors added yet</p>
                        <p class="text-sm text-gray-400">Create your first vendor to get started</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Vendor Detail Modal -->
        @if($showVendorDetail && $selectedVendor)
            <div class="fixed inset-0 z-50 flex items-center justify-center" style="background-color: rgba(0, 0, 0, 0.3);" wire:click="closeVendorDetail">
                <div class="bg-white rounded-lg shadow-xl max-w-md w-full mx-4 max-h-[80vh] overflow-hidden" wire:click.stop>
                    <!-- Modal Header -->
                    <div class="flex items-center justify-between p-6 border-b">
                        <h3 class="text-xl font-bold text-gray-800">Vendor Details</h3>
                        <button
                            wire:click="closeVendorDetail"
                            class="text-gray-400 hover:text-gray-600"
                        >
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>

                    <!-- Modal Body -->
                    <div class="p-6">
                        <div class="text-center mb-6">
                            @if($selectedVendor['logo_path'])
                                <img src="{{ Storage::url($selectedVendor['logo_path']) }}" alt="{{ $selectedVendor['name'] }} Logo" class="max-w-full rounded-lg object-contain bg-gray-100 mx-auto mb-4">
                            @else
                                <div class="w-24 h-24 bg-[#03a1bf] rounded-lg flex items-center justify-center mx-auto mb-4">
                                    <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                            @endif
                            <h4 class="text-2xl font-bold text-gray-800 mb-2">{{ $selectedVendor['name'] }}</h4>
                            <span class="inline-block px-3 py-1 bg-[#03a1bf] text-white rounded-full text-sm font-medium">{{ $selectedVendor['category'] }}</span>
                        </div>

                        <div class="space-y-4">
                            @if($selectedVendor['contact_name'])
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center">
                                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500">Contact Name</p>
                                        <p class="font-medium text-gray-800">{{ $selectedVendor['contact_name'] }}</p>
                                    </div>
                                </div>
                            @endif

                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Phone Number</p>
                                    <p class="font-medium text-gray-800">{{ $selectedVendor['phone'] }}</p>
                                </div>
                            </div>

                            @if($selectedVendor['email'])
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center">
                                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500">Email Address</p>
                                        <p class="font-medium text-gray-800">{{ $selectedVendor['email'] }}</p>
                                    </div>
                                </div>
                            @endif

                            @if($selectedVendor['website'])
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center">
                                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500">Website</p>
                                        <a href="{{ $selectedVendor['website'] }}" target="_blank" rel="noopener noreferrer" class="font-medium text-gray-800 hover:text-blue-600 transition-colors">{{ $selectedVendor['website'] }}</a>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex space-x-3 mt-6">
                            <a href="tel:{{ $selectedVendor['phone'] }}" class="flex-1 bg-[#03a1bf] text-white py-3 px-4 rounded-lg text-center font-medium hover:bg-[#027a8f] transition-colors">
                                Call Now
                            </a>
                            @if($selectedVendor['email'])
                                <a href="mailto:{{ $selectedVendor['email'] }}" class="flex-1 bg-gray-100 text-gray-700 py-3 px-4 rounded-lg text-center font-medium hover:bg-gray-200 transition-colors">
                                    Email
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endif


        <!-- Vendors Modal -->
        @if($showModal)
            <div class="fixed inset-0 z-50 flex items-center justify-center" style="background-color: rgba(0, 0, 0, 0.3);" wire:click="closeModal">
                <div class="bg-white rounded-lg shadow-xl max-w-4xl w-full mx-4 max-h-[80vh] overflow-hidden" wire:click.stop>
                    <!-- Modal Header -->
                    <div class="flex items-center justify-between p-6 border-b">
                        <h3 class="text-2xl font-bold text-gray-800">All Vendors</h3>
                        <button
                            wire:click="closeModal"
                            class="text-gray-400 hover:text-gray-600"
                        >
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>

                    <!-- Modal Body -->
                    <div class="p-6 overflow-y-auto" style="max-height: 60vh;">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach($this->getModalVendors() as $vendor)
                                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition-all duration-300 cursor-pointer" wire:click="showVendorDetails({{ $vendor['id'] }})">
                                    <div class="p-4">
                                        <div class="flex items-start space-x-3">
                                            <!-- Logo -->
                                            <div class="flex-shrink-0">
                                                @if($vendor['logo_path'])
                                                    <img src="{{ Storage::url($vendor['logo_path']) }}" alt="{{ $vendor['name'] }} Logo" class="w-18 h-18 rounded-lg object-contain bg-gray-50 border border-gray-200">
                                                @else
                                                    <div class="w-18 h-18 bg-[#03a1bf] rounded-lg flex items-center justify-center">
                                                        <svg class="w-9 h-9 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                                        </svg>
                                                    </div>
                                                @endif
                                            </div>

                                            <!-- Content -->
                                            <div class="flex-1 min-w-0">
                                                <div class="flex items-start justify-between">
                                                    <div>
                                                        <h4 class="font-semibold text-gray-900 text-base mb-1">{{ $vendor['name'] }}</h4>
                                                        @if($vendor['contact_name'])
                                                            <p class="text-sm text-gray-600 mb-2">{{ $vendor['contact_name'] }}</p>
                                                        @endif
                                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-[#03a1bf] text-white">
                                                            {{ $vendor['category'] }}
                                                        </span>
                                                    </div>
                                                </div>

                                                <!-- Contact Info -->
                                                <div class="mt-3 space-y-1">
                                                    <div class="flex items-center text-sm text-gray-600">
                                                        <svg class="w-3.5 h-3.5 mr-2 text-[#03a1bf]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                                        </svg>
                                                        {{ $vendor['phone'] }}
                                                    </div>

                                                    @if($vendor['email'])
                                                        <div class="flex items-center text-sm text-gray-600">
                                                            <svg class="w-3.5 h-3.5 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                                            </svg>
                                                            <span class="truncate">{{ $vendor['email'] }}</span>
                                                        </div>
                                                    @endif

                                                    @if($vendor['website'])
                                                        <div class="flex items-center text-sm text-gray-600">
                                                            <svg class="w-3.5 h-3.5 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                            </svg>
                                                            <a href="{{ $vendor['website'] }}" target="_blank" rel="noopener noreferrer" class="truncate hover:text-blue-600 transition-colors">{{ $vendor['website'] }}</a>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Modal Footer with Pagination -->
                    <div class="flex items-center justify-between p-6 border-t bg-gray-50">
                        <div class="flex items-center space-x-4">
                            <span class="text-sm text-gray-600">{{ count($vendors) }} total vendors</span>
                            @if($this->getTotalPages() > 1)
                                <span class="text-sm text-gray-600">
                                    Page {{ $modalPage }} of {{ $this->getTotalPages() }}
                                </span>
                            @endif
                        </div>
                        <div class="flex items-center space-x-3">
                            @if($this->getTotalPages() > 1)
                                <button
                                    wire:click="previousPage"
                                    @if($modalPage <= 1) disabled @endif
                                    wire:loading.attr="disabled"
                                    wire:loading.class="opacity-50"
                                    class="px-3 py-1 text-sm bg-gray-200 text-gray-700 rounded hover:bg-gray-300 disabled:opacity-50 disabled:cursor-not-allowed"
                                >
                                    <span wire:loading.remove wire:target="previousPage">Previous</span>
                                    <span wire:loading wire:target="previousPage">Loading...</span>
                                </button>
                                <button
                                    wire:click="nextPage"
                                    @if($modalPage >= $this->getTotalPages()) disabled @endif
                                    wire:loading.attr="disabled"
                                    wire:loading.class="opacity-50"
                                    class="px-3 py-1 text-sm bg-gray-200 text-gray-700 rounded hover:bg-gray-300 disabled:opacity-50 disabled:cursor-not-allowed"
                                >
                                    <span wire:loading.remove wire:target="nextPage">Next</span>
                                    <span wire:loading wire:target="nextPage">Loading...</span>
                                </button>
                            @endif
                            <button
                                wire:click="closeModal"
                                class="px-4 py-2 bg-[#03a1bf] text-white rounded-lg hover:bg-[#027a8f] transition-colors"
                            >
                                Close
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
