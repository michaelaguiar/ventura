<div class="flex justify-center w-full bg-gradient-to-t from-[#27aac4] to-white mt-[-50px]">
    <!-- Main Content Container -->
    <div class="max-w-screen-xl w-full">

        <!-- Desktop Layout - Side by Side -->
        <div class="hidden lg:flex relative " style="">
            <!-- Background Hand Image -->
            <div class="absolute w-[630px] h-[669px] bottom-0 left-[300px] xl:left-[35%]" style="background-image: url('{{ asset('images/hand_sub.png') }}'); background-size: 630px 669px; background-repeat: no-repeat; background-position: right bottom; z-index: 1;">
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
                            <!-- <div class="flex flex-col items-center">
                                <a href="#" class="bg-[#f0ad4e] rounded-lg flex items-center justify-center p-3 hover:bg-[#ec9c2e] transition-colors w-full h-12">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                                    </svg>
                                </a>
                                <span class="text-[9px] text-gray-700 font-medium mt-1">EMERGENCY</span>
                            </div> -->

                            <!-- Row 2 -->
                            <div class="flex flex-col items-center">
                                <a href="/community/{{ $community->id }}/vendors" class="bg-[#72d0df] rounded-lg flex items-center justify-center p-3 hover:bg-[#5bc5d6] transition-colors w-full h-12">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </a>
                                <span class="text-[9px] text-gray-700 font-medium mt-1">VENDORS</span>
                            </div>
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

                            <!-- Row 3 -->
                            <!-- <div class="flex flex-col items-center">
                                <a href="#" class="bg-[#72d0df] rounded-lg flex items-center justify-center p-3 hover:bg-[#5bc5d6] transition-colors w-full h-12">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </a>
                                <span class="text-[9px] text-gray-700 font-medium mt-1">RESERVATIONS</span>
                            </div>
                            <div class="flex flex-col items-center">
                                <a href="#" class="bg-[#72d0df] rounded-lg flex items-center justify-center p-3 hover:bg-[#5bc5d6] transition-colors w-full h-12">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path>
                                    </svg>
                                </a>
                                <span class="text-[9px] text-gray-700 font-medium mt-1">MAP</span>
                            </div>
                            <div class="flex flex-col items-center">
                                <a href="#" class="bg-[#72d0df] rounded-lg flex items-center justify-center p-3 hover:bg-[#5bc5d6] transition-colors w-full h-12">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                    </svg>
                                </a>
                                <span class="text-[9px] text-gray-700 font-medium mt-1">MESSAGES</span>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>

            <!-- Phone Content Overlay -->

            <!-- Left Side - Form Section -->
            <div class="flex flex-col px-8 pt-24 pb-6 z-2">
                <h1 class="text-2xl font-bold text-gray-800 mb-8">Add an Activity</h1>

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
                <form wire:submit="addActivity" class="space-y-4 max-w-sm">
                    <!-- Activity Name -->
                    <div>
                        <label for="activityName" class="block text-xs font-bold text-gray-700 mb-2 tracking-wider">
                            ACTIVITY NAME
                        </label>
                        <input
                            type="text"
                            id="activityName"
                            wire:model="formData.name"
                            placeholder="Activity Name"
                            class="w-full px-4 py-3 border border-[#72d0df] rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-gray-900 bg-white"
                            required
                        >
                        <x-input-error for="formData.name" />
                    </div>

                    <!-- Date and Time Row -->
                    <div class="grid grid-cols-2 gap-4" x-data="{
                        startDate: $wire.entangle('formData.start_date'),
                        endDate: $wire.entangle('formData.end_date'),
                        init() {
                           this.$watch('startDate', (value) => {
                               this.updateEndDateMin();
                           });
                           this.$nextTick(() => {
                               this.updateEndDateMin();
                           });
                        },
                        validateEndDateTime() {
                            this.validateDateTime('startDate', 'startTime', 'endDate', 'endTime');
                        },
                        updateEndDateMin() {
                            const startDateValue = this.startDate;
                            const endDateInput = document.getElementById('endDate');
                            if (startDateValue && endDateInput) {
                                endDateInput.min = startDateValue;
                                // If current end date is before new start date, update it
                                if (this.endDate && this.endDate < startDateValue) {
                                    this.endDate = startDateValue;
                                    $wire.set('formData.end_date', startDateValue);
                                }
                            }
                        },
                        enforceMinDate(inputId, minDateValue) {
                            const input = document.getElementById(inputId);
                            if (input && minDateValue) {
                                if (input.value && input.value < minDateValue) {
                                    input.value = minDateValue;
                                    if (inputId === 'endDate') {
                                        this.endDate = minDateValue;
                                    }
                                    $wire.set('formData.end_date', minDateValue);
                                }
                            }
                        },
                        validateDateTime(startDateId, startTimeId, endDateId, endTimeId) {
                            const startDate = document.getElementById(startDateId).value;
                            const startTime = document.getElementById(startTimeId).value;
                            const endDate = document.getElementById(endDateId).value;
                            const endTime = document.getElementById(endTimeId).value;

                            if (startDate && startTime && endDate && endTime) {
                                const startDateTime = new Date(startDate + 'T' + startTime);
                                const endDateTime = new Date(endDate + 'T' + endTime);

                                const endDateInput = document.getElementById(endDateId);
                                const endTimeInput = document.getElementById(endTimeId);

                                if (endDateTime < startDateTime) {
                                    endDateInput.setCustomValidity('End date and time must be greater than or equal to start date and time');
                                    endTimeInput.setCustomValidity('End date and time must be greater than or equal to start date and time');
                                } else {
                                    endDateInput.setCustomValidity('');
                                    endTimeInput.setCustomValidity('');
                                }
                            }
                        }
                    }">
                        <!-- Start Date -->
                        <div>
                            <label for="startDate" class="block text-xs font-bold text-gray-700 mb-2 tracking-wider">
                                START DATE
                            </label>
                            <div class="relative">
                                <x-alias::date-picker wire:model="formData.start_date" min="{{ $formData['start_date'] ?? now() }}" defaultDate="{{ date('m/d/Y', strtotime($formData['start_date'] ?? 'now')) }}" required class="w-full px-4 py-3 pr-10 border border-[#72d0df] rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-gray-900 bg-white" />

                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-[#03a1bf]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            </div>
                            <x-input-error for="formData.start_date" />
                        </div>

                        <!-- Start Time -->
                        <div>
                            <label for="startTime" class="block text-xs font-bold text-gray-700 mb-2 tracking-wider">
                                START TIME
                            </label>
                            <div class="relative">
                                <x-alias::time-picker wire:model="formData.start_time" required class="w-full px-4 py-3 pr-10 border border-[#72d0df] rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-gray-900 bg-white" />

                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-[#03a1bf]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                            </div>
                            <x-input-error for="formData.start_time" />
                        </div>
                    </div>

                    <!-- End Date and Time Row -->
                    <div class="grid grid-cols-2 gap-4">
                        <!-- End Date -->
                        <div>
                            <label for="endDate" class="block text-xs font-bold text-gray-700 mb-2 tracking-wider">
                                END DATE
                            </label>
                            <div class="relative">
                                <x-alias::date-picker wire:model="formData.end_date" min="{{ $formData['start_date'] ?? now() }}" defaultDate="{{ date('m/d/Y', strtotime($formData['end_date'] ?? 'now')) }}" required class="w-full px-4 py-3 pr-10 border border-[#72d0df] rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-gray-900 bg-white" />

                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-[#03a1bf]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            </div>
                            <x-input-error for="formData.end_date" />
                        </div>

                        <!-- End Time -->
                        <div>
                            <label for="endTime" class="block text-xs font-bold text-gray-700 mb-2 tracking-wider">
                                END TIME
                            </label>
                            <div class="relative">
                                <x-alias::time-picker wire:model="formData.end_time" required class="w-full px-4 py-3 pr-10 border border-[#72d0df] rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-gray-900 bg-white" />

                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-[#03a1bf]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                            </div>
                            <x-input-error for="formData.end_time" />
                        </div>
                    </div>

                    <!-- Location -->
                    <div>
                        <label for="location" class="block text-xs font-bold text-gray-700 mb-2 tracking-wider">
                            LOCATION
                        </label>
                        <div class="relative">
                            <select
                                id="location"
                                wire:model="formData.location"
                                class="w-full px-4 py-3 pr-10 border border-[#72d0df] rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-gray-900 bg-white appearance-none"
                                required
                            >
                                <option value="">Select Location</option>
                                <option value="Community Center">Community Center</option>
                                <option value="Pool Area">Pool Area</option>
                                <option value="Clubhouse">Clubhouse</option>
                                <option value="Fitness Center">Fitness Center</option>
                                <option value="Tennis Court">Tennis Court</option>
                                <option value="Playground">Playground</option>
                                <option value="Other">Other</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-[#03a1bf]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </div>
                        <x-input-error for="formData.location" />
                    </div>

                    <!-- Activity Details -->
                    <div x-data="{
                        details: $wire.entangle('formData.details'),
                        get charCount() {
                            return this.details ? this.details.length : 0;
                        },
                        get isNearLimit() {
                            return this.charCount >= 200;
                        },
                        get isOverLimit() {
                            return this.charCount > 255;
                        }
                    }">
                        <label for="activityDetails" class="block text-xs font-bold text-gray-700 mb-2 tracking-wider">
                            ACTIVITY DETAILS
                        </label>
                        <textarea
                            id="activityDetails"
                            wire:model="formData.details"
                            x-model="details"
                            placeholder="Enter activity details..."
                            rows="4"
                            maxlength="255"
                            class="w-full px-4 py-3 border border-[#72d0df] rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-gray-900 bg-white resize-none"
                        ></textarea>
                        <div class="flex justify-between items-center mt-1">
                            <x-input-error for="formData.details" />
                            <div class="text-xs"
                                 :class="{
                                     'text-red-500': isNearLimit,
                                     'text-gray-500': !isNearLimit
                                 }">
                                <span x-text="charCount"></span>/255
                            </div>
                        </div>
                    </div>

                    <!-- Add Activity Button -->
                    <div class="pt-4">
                        <button
                            type="submit"
                            class="bg-[#03a1bf] text-white px-8 py-3 rounded-lg cursor-pointer hover:bg-[#027a8f] focus:outline-none focus:ring-2 focus:ring-blue-500 flex items-center font-medium"
                            wire:loading.attr="disabled"
                            wire:loading.class="opacity-50 cursor-not-allowed"
                        >
                            <span wire:loading.remove>Add Activity</span>
                            <span wire:loading>Adding...</span>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Right Side - Activities List -->
            <div class="w-[500px] px-8 pt-24 pb-6 max-w-md z-2 ml-auto">
                <div class="flex items-center justify-between mb-8">
                    <h2 class="text-2xl font-bold text-gray-800">Upcoming Activities</h2>
                </div>

                <div class="grid grid-cols-1 gap-2">
                    @forelse(array_slice($activities, 0, 6) as $activity)
                        <div class="bg-gray-100 rounded-lg p-3 hover:bg-gray-200 transition-colors max-w-sm">
                            <div class="flex items-start space-x-3">
                                <div class="text-center">
                                    <div class="text-xs text-[#03a1bf] font-medium">
                                        {{ $activity['start_date_time']->format('M') }}
                                    </div>
                                    <div class="text-lg font-bold text-gray-800">
                                        {{ $activity['start_date_time']->format('d') }}
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <h4 class="font-semibold text-gray-800 mb-1 text-sm">{{ $activity['name'] }}</h4>
                                    <p class="text-xs text-gray-600 mb-1">{{ Str::limit($activity['details'] ?? 'No details provided', 60) }}</p>
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center text-xs text-[#03a1bf]">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            @if($activity['start_date_time']->format('Y-m-d') !== $activity['end_date_time']->format('Y-m-d'))
                                                {{ $activity['start_date_time']->format('M j, g:i A') }} - {{ $activity['end_date_time']->format('M j, g:i A') }}
                                            @else
                                                {{ $activity['start_date_time']->format('g:i A') }} - {{ $activity['end_date_time']->format('g:i A') }}
                                            @endif
                                        </div>
                                        <div class="flex items-center text-xs text-gray-500">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            </svg>
                                            {{ $activity['location'] }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-8">
                            <svg class="w-12 h-12 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <p class="text-gray-500">No activities scheduled yet</p>
                            <p class="text-sm text-gray-400">Create your first activity to get started</p>
                        </div>
                    @endforelse
                </div>

                @if(count($activities) > 6)
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

        <!-- Activities Modal -->
        @if($showModal)
            <div class="fixed inset-0 z-50 flex items-center justify-center" style="background-color: rgba(0, 0, 0, 0.3);" wire:click="closeModal">
                <div class="bg-white rounded-lg shadow-xl max-w-4xl w-full mx-4 max-h-[80vh] overflow-hidden" wire:click.stop>
                    <!-- Modal Header -->
                    <div class="flex items-center justify-between p-6 border-b">
                        <h3 class="text-2xl font-bold text-gray-800">All Activities</h3>
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
                            @foreach($this->getModalActivities() as $activity)
                                <div class="bg-gray-50 rounded-lg p-4 hover:bg-gray-100 transition-colors">
                                    <div class="flex items-start space-x-4">
                                        <div class="text-center">
                                            <div class="text-xs text-[#03a1bf] font-medium">
                                                {{ $activity['start_date_time']->format('M') }}
                                            </div>
                                            <div class="text-xl font-bold text-gray-800">
                                                {{ $activity['start_date_time']->format('d') }}
                                            </div>
                                        </div>
                                        <div class="flex-1">
                                            <h4 class="font-semibold text-gray-800 mb-2">{{ $activity['name'] }}</h4>
                                            <p class="text-sm text-gray-600 mb-2">{{ $activity['details'] ?? 'No details provided' }}</p>
                                            <div class="flex items-center justify-between">
                                                <div class="flex items-center text-xs text-[#03a1bf]">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                    @if($activity['start_date_time']->format('Y-m-d') !== $activity['end_date_time']->format('Y-m-d'))
                                                        {{ $activity['start_date_time']->format('M j, g:i A') }} - {{ $activity['end_date_time']->format('M j, g:i A') }}
                                                    @else
                                                        {{ $activity['start_date_time']->format('g:i A') }} - {{ $activity['end_date_time']->format('g:i A') }}
                                                    @endif
                                                </div>
                                                <div class="flex items-center text-xs text-gray-500">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    </svg>
                                                    {{ $activity['location'] }}
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
                            <span class="text-sm text-gray-600">{{ count($activities) }} total activities</span>
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

        <!-- Mobile/Tablet Layout - Stacked -->
        <div class="lg:hidden">
            <!-- Form Section -->
            <div class="px-8 pt-12 pb-6">
                <h1 class="text-2xl font-bold text-gray-800 mb-6">Add an Activity</h1>

                @if (session()->has('message'))
                    <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                        {{ session('message') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                        <ul class="list-disc list-inside text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @error('general')
                    <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg text-sm">
                        {{ $message }}
                    </div>
                @enderror

                <!-- Form -->
                <form wire:submit="addActivity" class="space-y-4 max-w-sm mx-auto">
                    <!-- Activity Name -->
                    <div>
                        <label for="activityNameMobile" class="block text-xs font-bold text-gray-700 mb-2 tracking-wider">
                            ACTIVITY NAME
                        </label>
                        <input
                            type="text"
                            id="activityNameMobile"
                            wire:model="formData.name"
                            placeholder="Activity Name"
                            class="w-full px-4 py-3 border border-[#72d0df] rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-gray-900 bg-white"
                            required
                        >
                        <x-input-error for="formData.name" />
                    </div>

                    <!-- Date and Time Section -->
                    <div x-data="{
                        startDateMobile: $wire.entangle('formData.start_date'),
                        endDateMobile: $wire.entangle('formData.end_date'),
                        init() {
                           this.$watch('startDateMobile', (value) => {
                               this.updateEndDateMinMobile();
                           });
                           this.$nextTick(() => {
                               this.updateEndDateMinMobile();
                           });
                        },

                        updateEndDateMinMobile() {
                            const startDateValue = this.startDateMobile;
                            const endDateInput = document.getElementById('endDateMobile');
                            if (startDateValue && endDateInput) {
                                endDateInput.min = startDateValue;
                                // If current end date is before new start date, update it
                                if (this.endDateMobile && this.endDateMobile < startDateValue) {
                                    this.endDateMobile = startDateValue;
                                    $wire.set('formData.end_date', startDateValue);
                                }
                            }
                        },
                        enforceMinDateMobile(inputId, minDateValue) {
                            const input = document.getElementById(inputId);
                            if (input && minDateValue) {
                                if (input.value && input.value < minDateValue) {
                                    input.value = minDateValue;
                                    if (inputId === 'endDateMobile') {
                                        this.endDateMobile = minDateValue;
                                    }
                                    $wire.set('formData.end_date', minDateValue);
                                }
                            }
                        },
                        validateDateTime(startDateId, startTimeId, endDateId, endTimeId) {
                            const startDate = document.getElementById(startDateId).value;
                            const startTime = document.getElementById(startTimeId).value;
                            const endDate = document.getElementById(endDateId).value;
                            const endTime = document.getElementById(endTimeId).value;

                            if (startDate && startTime && endDate && endTime) {
                                const startDateTime = new Date(startDate + 'T' + startTime);
                                const endDateTime = new Date(endDate + 'T' + endTime);

                                const endDateInput = document.getElementById(endDateId);
                                const endTimeInput = document.getElementById(endTimeId);

                                if (endDateTime < startDateTime) {
                                    endDateInput.setCustomValidity('End date and time must be greater than or equal to start date and time');
                                    endTimeInput.setCustomValidity('End date and time must be greater than or equal to start date and time');
                                } else {
                                    endDateInput.setCustomValidity('');
                                    endTimeInput.setCustomValidity('');
                                }
                            }
                        }
                    }">

                    <!-- Start Date -->
                    <div>
                        <label for="startDateMobile" class="block text-xs font-bold text-gray-700 mb-2 tracking-wider">
                            START DATE
                        </label>
                        <input
                            type="date"
                            id="startDateMobile"
                            wire:model="formData.start_date"
                            class="w-full px-4 py-3 border border-[#72d0df] rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-gray-900 bg-white"
                            required
                            @change="validateEndDateTime()"
                        >
                        <x-input-error for="formData.start_date" />
                    </div>

                    <!-- Start Time -->
                    <div>
                        <label for="startTimeMobile" class="block text-xs font-bold text-gray-700 mb-2 tracking-wider">
                            START TIME
                        </label>
                        <input
                            type="time"
                            id="startTimeMobile"
                            wire:model="formData.start_time"
                            class="w-full px-4 py-3 border border-[#72d0df] rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-gray-900 bg-white"
                            required
                            @change="validateEndDateTime()"
                        >
                        <x-input-error for="formData.start_time" />
                    </div>

                    <!-- End Date -->
                    <div>
                        <label for="endDateMobile" class="block text-xs font-bold text-gray-700 mb-2 tracking-wider">
                            END DATE
                        </label>
                        <input
                            type="date"
                            id="endDateMobile"
                            wire:model="formData.end_date"
                            class="w-full px-4 py-3 border border-[#72d0df] rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-gray-900 bg-white"
                            required
                            :min="startDateMobile || ''"
                            @change="validateEndDateTime()"
                            x-on:input="if ($event.target.value && startDateMobile && $event.target.value < startDateMobile) { $event.target.value = startDateMobile; endDateMobile = startDateMobile; $wire.set('formData.end_date', startDateMobile); }"
                            x-on:blur="if ($event.target.value && startDateMobile && $event.target.value < startDateMobile) { $event.target.value = startDateMobile; endDateMobile = startDateMobile; $wire.set('formData.end_date', startDateMobile); }"
                            x-on:keydown="if ($event.key === 'Enter' && $event.target.value && startDateMobile && $event.target.value < startDateMobile) { $event.preventDefault(); $event.target.value = startDateMobile; endDateMobile = startDateMobile; $wire.set('formData.end_date', startDateMobile); }"
                            @focus="enforceMinDateMobile('endDateMobile', startDateMobile)"
                        >
                        <x-input-error for="formData.end_date" />
                    </div>

                    <!-- End Time -->
                    <div>
                        <label for="endTimeMobile" class="block text-xs font-bold text-gray-700 mb-2 tracking-wider">
                            END TIME
                        </label>
                        <input
                            type="time"
                            id="endTimeMobile"
                            wire:model="formData.end_time"
                            class="w-full px-4 py-3 border border-[#72d0df] rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-gray-900 bg-white"
                            required
                            @change="validateEndDateTime()"
                        >
                        <x-input-error for="formData.end_time" />
                    </div>

                    </div>

                    <!-- Location -->
                    <div>
                        <label for="locationMobile" class="block text-xs font-bold text-gray-700 mb-2 tracking-wider">
                            LOCATION
                        </label>
                        <select
                            id="locationMobile"
                            wire:model="formData.location"
                            class="w-full px-4 py-3 border border-[#72d0df] rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-gray-900 bg-white"
                            required
                        >
                            <option value="">Select Location</option>
                            <option value="Community Center">Community Center</option>
                            <option value="Pool Area">Pool Area</option>
                            <option value="Clubhouse">Clubhouse</option>
                            <option value="Fitness Center">Fitness Center</option>
                            <option value="Tennis Court">Tennis Court</option>
                            <option value="Playground">Playground</option>
                            <option value="Other">Other</option>
                        </select>
                        <x-input-error for="formData.location" />
                    </div>

                    <!-- Activity Details -->
                    <div>
                        <label for="activityDetailsMobile" class="block text-xs font-bold text-gray-700 mb-2 tracking-wider">
                            ACTIVITY DETAILS
                        </label>
                        <textarea
                            id="activityDetailsMobile"
                            wire:model="formData.details"
                            placeholder="Enter activity details..."
                            rows="4"
                            class="w-full px-4 py-3 border border-[#72d0df] rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-gray-900 bg-white resize-none"
                        ></textarea>
                        <x-input-error for="formData.details" />
                    </div>

                    <!-- Add Activity Button -->
                    <div class="pt-4">
                        <button
                            type="submit"
                            class="w-full bg-[#03a1bf] text-white px-8 py-3 cursor-pointer rounded-lg hover:bg-[#027a8f] focus:outline-none focus:ring-2 focus:ring-blue-500 flex items-center justify-center font-medium"
                            wire:loading.attr="disabled"
                            wire:loading.class="opacity-50 cursor-not-allowed"
                        >
                            <span wire:loading.remove>Add Activity</span>
                            <span wire:loading>Adding...</span>
                        </button>
                    </div>
                </form>

                <!-- Activities List for Mobile -->
                <div class="mt-8">
                    <h2 class="text-xl font-bold text-gray-800 mb-4">Upcoming Activities</h2>
                    <div class="space-y-3">
                        @forelse(array_slice($activities, 0, 6) as $activity)
                            <div class="bg-gray-50 rounded-lg p-4 hover:bg-gray-100 transition-colors">
                                <div class="flex items-start space-x-3">
                                    <div class="text-center">
                                        <div class="text-xs text-[#03a1bf] font-medium">
                                            {{ $activity['start_date_time']->format('M') }}
                                        </div>
                                        <div class="text-lg font-bold text-gray-800">
                                            {{ $activity['start_date_time']->format('d') }}
                                        </div>
                                    </div>
                                    <div class="flex-1">
                                        <h4 class="font-semibold text-gray-800 mb-2">{{ $activity['name'] }}</h4>
                                        <p class="text-sm text-gray-600 mb-2">{{ $activity['details'] ?? 'No details provided' }}</p>
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center text-xs text-[#03a1bf]">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                @if($activity['start_date_time']->format('Y-m-d') !== $activity['end_date_time']->format('Y-m-d'))
                                                    {{ $activity['start_date_time']->format('M j, g:i A') }} - {{ $activity['end_date_time']->format('M j, g:i A') }}
                                                @else
                                                    {{ $activity['start_date_time']->format('g:i A') }} - {{ $activity['end_date_time']->format('g:i A') }}
                                                @endif
                                            </div>
                                            <div class="flex items-center text-xs text-gray-500">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                </svg>
                                                {{ $activity['location'] }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-6">
                                <p class="text-gray-500 text-sm">No activities scheduled yet</p>
                            </div>
                        @endforelse
                    </div>

                    @if(count($activities) > 6)
                        <div class="text-center mt-4">
                            <button
                                class="bg-[#03a1bf] text-white px-4 py-2 rounded-lg cursor-pointer hover:bg-[#027a8f] focus:outline-none focus:ring-2 focus:ring-blue-500 font-medium text-sm"
                                wire:click="openModal"
                            >
                                SHOW MORE
                            </button>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Phone Mockup Section - Below Form on Mobile -->
            <div class="flex justify-center items-end flex-grow px-4">
                <div class="relative">
                    <img
                        src="{{ asset('images/community-hand.png') }}"
                        alt="Phone Mockup"
                        class="w-full h-full object-contain object-bottom"
                    >
                </div>
            </div>
        </div>
    </div>
</div>
