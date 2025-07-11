<div class="flex justify-center w-full bg-gradient-to-t from-[#27aac4] to-white mt-[-50px]">
    <!-- Main Content Container -->
    <div class="max-w-screen-xl w-full">
        <div class="lg:flex relative min-h-[750px]">
            <!-- Form Section -->
            <div class="flex flex-col px-8 pt-12 lg:pt-24 pb-6 w-full lg:w-1/2 xl:w-1/3 z-2 max-w-sm mx-auto lg:mx-0 min-w-[450px]">
                <h1 class="text-2xl font-bold text-gray-800 mb-6 lg:mb-8">Submit Maintenance Request</h1>

                <!-- Messages -->
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

                <!-- Single Form -->
                <form wire:submit="addMaintenanceRequest" class="space-y-4 w-full">
                    <!-- Title -->
                    <div>
                        <label for="requestTitle" class="block text-xs font-bold text-gray-700 mb-2 tracking-wider">
                            TITLE <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="text"
                            id="requestTitle"
                            wire:model="formData.title"
                            placeholder="Brief description of the issue"
                            class="w-full px-4 py-3 border border-[#72d0df] rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-gray-900 bg-white"
                            required
                        >
                        <x-input-error for="formData.title" />
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="requestDescription" class="block text-xs font-bold text-gray-700 mb-2 tracking-wider">
                            DESCRIPTION <span class="text-red-500">*</span>
                        </label>
                        <textarea
                            id="requestDescription"
                            wire:model="formData.description"
                            placeholder="Detailed description of the maintenance issue"
                            rows="4"
                            class="w-full px-4 py-3 border border-[#72d0df] rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-gray-900 bg-white resize-none"
                            required
                        ></textarea>
                        <x-input-error for="formData.description" />
                    </div>

                    <!-- Priority -->
                    <div>
                        <label for="requestPriority" class="block text-xs font-bold text-gray-700 mb-2 tracking-wider">
                            PRIORITY <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <select
                                id="requestPriority"
                                wire:model="formData.priority"
                                class="w-full px-4 py-3 pr-10 border border-[#72d0df] rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-gray-900 bg-white appearance-none"
                                required
                            >
                                <option value="">Select Priority</option>
                                <option value="low">Low</option>
                                <option value="medium">Medium</option>
                                <option value="high">High</option>
                                <option value="urgent">Urgent</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-[#03a1bf]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </div>
                        <x-input-error for="formData.priority" />
                    </div>

                    <!-- Category -->
                    <div>
                        <label for="requestCategory" class="block text-xs font-bold text-gray-700 mb-2 tracking-wider">
                            CATEGORY <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <select
                                id="requestCategory"
                                wire:model="formData.category"
                                class="w-full px-4 py-3 pr-10 border border-[#72d0df] rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-gray-900 bg-white appearance-none"
                                required
                            >
                                <option value="">Select Category</option>
                                @foreach(\App\Enums\MaintenanceRequestCategory::cases() as $category)
                                    <option value="{{ $category->value }}">{{ $category->label() }}</option>
                                @endforeach
                            </select>
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-[#03a1bf]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </div>
                        <x-input-error for="formData.category" />
                    </div>

                    <!-- Photos Upload -->
                    <div x-data="{ fileName: 'No files selected.', fileSelected: false, fileCount: 0 }" x-init="$wire.on('maintenance-request-added', () => { fileName = 'No files selected.'; fileSelected = false; fileCount = 0; })">
                        <label class="block text-xs font-bold text-gray-700 mb-2 tracking-wider">
                            PHOTOS
                        </label>
                        <div>
                            <input
                                type="file"
                                wire:model="photos"
                                accept="image/*"
                                multiple
                                class="hidden"
                                id="photos-upload"
                                x-ref="fileInput"
                                @change="
                                    fileCount = $event.target.files.length;
                                    fileName = fileCount > 0 ? (fileCount === 1 ? '1 file selected' : fileCount + ' files selected') : 'No files selected.';
                                    fileSelected = fileCount > 0
                                "
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
                        <x-input-error for="photos.*" />

                        @if ($photos)
                            <div class="mt-4 grid grid-cols-2 gap-2">
                                @foreach ($photos as $index => $photo)
                                    <div class="relative">
                                        <img src="{{ $photo->temporaryUrl() }}" alt="Photo Preview" class="w-full h-20 object-cover border rounded-lg">
                                        <button
                                            type="button"
                                            wire:click="removePhoto({{ $index }})"
                                            class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs hover:bg-red-600"
                                        >
                                            ×
                                        </button>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-4">
                        <button
                            type="submit"
                            class="w-full lg:w-auto bg-[#03a1bf] text-white px-8 py-3 rounded-lg hover:bg-[#027a8f] focus:outline-none focus:ring-2 focus:ring-blue-500 flex items-center justify-center font-medium disabled:opacity-50 disabled:cursor-not-allowed disabled:hover:bg-[#03a1bf]"
                            wire:loading.attr="disabled"
                            wire:loading.class="opacity-50 cursor-not-allowed"
                            wire:target="photos"
                        >
                            <span wire:loading.remove wire:target="photos">Submit Request</span>
                            <span wire:loading wire:target="photos">Uploading...</span>
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" wire:loading.remove wire:target="photos">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            <svg class="animate-spin w-5 h-5 ml-2" fill="none" viewBox="0 0 24 24" wire:loading wire:target="photos">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Requests List Section -->
            <div class="px-8 pb-6 lg:pt-24 w-full lg:w-1/2 max-w-md z-2 lg:ml-auto">
                <div class="flex items-center justify-between mb-6 lg:mb-8">
                    <h2 class="text-xl lg:text-2xl font-bold text-gray-800">Recent Requests</h2>
                </div>

                <div class="space-y-3 lg:space-y-2 lg:grid lg:grid-cols-1 lg:gap-2">
                    @forelse(array_slice($maintenanceRequests, 0, 6) as $request)
                        <div class="bg-gray-50 lg:bg-gray-100 rounded-lg p-4 lg:p-3 hover:bg-gray-100 lg:hover:bg-gray-200 transition-colors cursor-pointer lg:max-w-sm" wire:click="openDetailsModal({{ $request['id'] }})">
                            <div class="flex items-start space-x-3">
                                <div class="flex-shrink-0">
                                    {{-- @if(count($request['photos']) > 0)
                                        <img src="{{ Storage::url($request['photos'][0]) }}" alt="Request Photo" class="w-12 h-12 rounded-lg object-cover">
                                    @else --}}
                                        <div class="w-12 h-12 bg-[#03a1bf] rounded-lg flex items-center justify-center">
                                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            </svg>
                                        </div>
                                    {{--@endif --}}
                                </div>
                                <div class="flex-1">
                                    <h4 class="font-semibold text-gray-800 mb-2 lg:mb-1 lg:text-sm">{{ $request['title'] }}</h4>
                                    <div class="flex flex-col space-y-1 lg:space-y-0 lg:flex-row lg:items-center lg:justify-between mb-2 lg:mb-1">
                                        <div class="flex items-center space-x-2">
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium {{ $this->getPriorityColor($request['priority']) }}">
                                                {{ ucfirst($request['priority']) }}
                                            </span>
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium {{ $this->getStatusColor($request['status']) }}">
                                                {{ ucfirst(str_replace('_', ' ', $request['status'])) }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="flex items-center text-sm lg:text-xs text-gray-500">
                                        <svg class="w-4 h-4 lg:w-3 lg:h-3 mr-2 lg:mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                        </svg>
                                        {{ $request['category'] instanceof \App\Enums\MaintenanceRequestCategory ? $request['category']->label() : $request['category'] }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-6 lg:py-8">
                            <svg class="w-12 h-12 mx-auto text-gray-400 mb-4 hidden lg:block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <p class="text-gray-500 text-sm lg:text-base">No maintenance requests yet</p>
                            <p class="text-sm text-gray-400 hidden lg:block">Submit your first request to get started</p>
                        </div>
                    @endforelse
                </div>

                @if(count($maintenanceRequests) > 6)
                    <div class="text-center mt-4">
                        <button
                            class="bg-[#03a1bf] text-white px-4 lg:px-6 py-2 rounded-lg hover:bg-[#027a8f] focus:outline-none focus:ring-2 focus:ring-blue-500 font-medium text-sm"
                            wire:click="openModal"
                        >
                            SHOW MORE
                        </button>
                    </div>
                @endif
            </div>

            <!-- Phone Mockup (Desktop Only) -->
            <div class="hidden lg:block absolute w-[630px] h-[669px] bottom-0 left-[35%]" style="background-image: url('{{ asset('images/hand_sub.png') }}'); background-size: 630px 669px; background-repeat: no-repeat; background-position: right bottom; z-index: 1;">
                <div class="w-[239px] h-[300px] flex flex-col ml-[63px] mt-[36px]">
                    <div class="flex-1 text-center">
                        <h3 class="font-bold text-[11px] text-gray-800">{{ $community->name ?? 'Desert Vista RV Resort' }}</h3>
                        <p class="text-[9px] text-gray-600">{{ $community->address ?? 'Community Address' }}</p>
                    </div>

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

                    <div class="bg-white flex-1 px-6 py-4 rounded-b-3xl relative z-10">
                        <div class="grid grid-cols-3 gap-3 h-full">
                            <div class="flex flex-col items-center">
                                <a href="/" class="bg-[#72d0df] rounded-lg flex items-center justify-center p-3 hover:bg-[#5bc5d6] transition-colors w-full h-12 relative z-20">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                    </svg>
                                </a>
                                <span class="text-[9px] text-gray-700 font-medium mt-1">WELCOME</span>
                            </div>
                            <div class="flex flex-col items-center">
                                <a href="/community/{{ $community->id }}/activities" class="bg-[#72d0df] rounded-lg flex items-center justify-center p-3 hover:bg-[#5bc5d6] transition-colors w-full h-12 relative z-20">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </a>
                                <span class="text-[9px] text-gray-700 font-medium mt-1">ACTIVITIES</span>
                            </div>
                            <div class="flex flex-col items-center">
                                <a href="/community/{{ $community->id }}/vendors" class="bg-[#72d0df] rounded-lg flex items-center justify-center p-3 hover:bg-[#5bc5d6] transition-colors w-full h-12 relative z-20">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </a>
                                <span class="text-[9px] text-gray-700 font-medium mt-1">VENDORS</span>
                            </div>
                            <div class="flex flex-col items-center">
                                <a href="/community/{{ $community->id }}/maintenance" class="bg-[#72d0df] rounded-lg flex items-center justify-center p-3 hover:bg-[#5bc5d6] transition-colors w-full h-12 relative z-20">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path>
                                    </svg>
                                </a>
                                <span class="text-[9px] text-gray-700 font-medium mt-1">MAINTENANCE</span>
                            </div>
                            <div class="flex flex-col items-center">
                                <a href="/community/{{ $community->id }}/amenities" class="bg-[#72d0df] rounded-lg flex items-center justify-center p-3 hover:bg-[#5bc5d6] transition-colors w-full h-12 relative z-20">
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
        </div>

        <!-- All Requests Modal -->
        @if($showModal)
            <div class="fixed inset-0 z-50 flex items-center justify-center" style="background-color: rgba(0, 0, 0, 0.3);" wire:click="closeModal">
                <div class="bg-white rounded-lg shadow-xl max-w-4xl w-full mx-4 max-h-[80vh] overflow-hidden" wire:click.stop>
                    <div class="flex items-center justify-between p-6 border-b">
                        <h3 class="text-2xl font-bold text-gray-800">All Maintenance Requests</h3>
                        <button wire:click="closeModal" class="text-gray-400 hover:text-gray-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                    <div class="p-6 overflow-y-auto" style="max-height: 60vh;">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach($this->getModalRequests() as $request)
                                <div class="bg-gray-50 rounded-lg p-4 hover:bg-gray-100 transition-colors cursor-pointer" wire:click="openDetailsModal({{ $request['id'] }})">
                                    <div class="flex items-start space-x-4">
                                        <div class="flex-shrink-0">
                                            @if(count($request['photos']) > 0)
                                                <img src="{{ Storage::url($request['photos'][0]) }}" alt="Request Photo" class="w-16 h-16 rounded-lg object-cover">
                                            @else
                                                <div class="w-16 h-16 bg-[#03a1bf] rounded-lg flex items-center justify-center">
                                                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    </svg>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="flex-1">
                                            <h4 class="font-semibold text-gray-800 mb-2">{{ $request['title'] }}</h4>
                                            <div class="flex items-center justify-between mb-2">
                                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium {{ $this->getPriorityColor($request['priority']) }}">
                                                    {{ ucfirst($request['priority']) }}
                                                </span>
                                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium {{ $this->getStatusColor($request['status']) }}">
                                                    {{ ucfirst(str_replace('_', ' ', $request['status'])) }}
                                                </span>
                                            </div>
                                            <div class="flex items-center text-xs text-gray-500">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                                </svg>
                                                {{ $request['category'] instanceof \App\Enums\MaintenanceRequestCategory ? $request['category']->label() : $request['category'] }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="flex items-center justify-between p-6 border-t bg-gray-50">
                        <div class="flex items-center space-x-4">
                            <span class="text-sm text-gray-600">{{ count($maintenanceRequests) }} total requests</span>
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

        <!-- Details Modal -->
        @if($showDetailsModal && $selectedRequest)
            <div class="fixed inset-0 z-50 flex items-center justify-center" style="background-color: rgba(0, 0, 0, 0.3);" wire:click="closeDetailsModal">
                <div class="bg-white rounded-lg shadow-xl max-w-2xl w-full mx-4 max-h-[80vh] overflow-hidden" wire:click.stop>
                    <div class="flex items-center justify-between p-6 border-b">
                        <div>
                            <h3 class="text-xl font-bold text-gray-800">{{ $selectedRequest['title'] }}</h3>
                            <div class="flex items-center space-x-2 mt-1">
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium {{ $this->getPriorityColor($selectedRequest['priority']) }}">
                                    {{ ucfirst($selectedRequest['priority']) }}
                                </span>
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium {{ $this->getStatusColor($selectedRequest['status']) }}">
                                    {{ ucfirst(str_replace('_', ' ', $selectedRequest['status'])) }}
                                </span>
                            </div>
                        </div>
                        <button wire:click="closeDetailsModal" class="text-gray-400 hover:text-gray-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                    <div class="p-6 overflow-y-auto" style="max-height: 60vh;">
                        <div class="space-y-4">
                            <div>
                                <h4 class="font-semibold text-gray-800 mb-2">Description</h4>
                                <p class="text-gray-600">{{ $selectedRequest['description'] }}</p>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-800 mb-2">Category</h4>
                                <p class="text-gray-600">{{ $selectedRequest['category'] instanceof \App\Enums\MaintenanceRequestCategory ? $selectedRequest['category']->label() : $selectedRequest['category'] }}</p>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-800 mb-2">Submitted</h4>
                                <p class="text-gray-600">{{ \Carbon\Carbon::parse($selectedRequest['created_at'])->format('F j, Y \a\t g:i A') }}</p>
                            </div>
                            @if(count($selectedRequest['photos']) > 0)
                                <div>
                                    <h4 class="font-semibold text-gray-800 mb-2">Photos</h4>
                                    <div class="grid grid-cols-2 gap-2">
                                        @foreach($selectedRequest['photos'] as $photo)
                                            <img src="{{ Storage::url($photo) }}" alt="Request Photo" class="w-full h-32 object-cover border rounded-lg">
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="flex items-center justify-end p-6 border-t bg-gray-50">
                        <button
                            wire:click="closeDetailsModal"
                            class="px-4 py-2 bg-[#03a1bf] text-white rounded-lg hover:bg-[#027a8f] transition-colors"
                        >
                            Close
                        </button>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
