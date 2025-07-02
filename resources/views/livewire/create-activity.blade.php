<div class="flex justify-center w-full bg-gradient-to-t from-[#27aac4] to-white mt-[-50px]">
    <!-- Main Content Container -->
    <div class="max-w-screen-xl w-full">

        <!-- Desktop Layout - Side by Side -->
        <div class="hidden lg:flex relative min-h-screen" style="background-image: url('{{ asset('images/community-hand.png') }}'); background-size: 796px 742px; background-repeat: no-repeat; background-position: bottom center;">
            <!-- Left Side - Form Section -->
            <div class="flex flex-col px-8 pt-24 pb-6 w-1/2">
                <h1 class="text-3xl font-bold text-gray-800 mb-8">Add an Activity</h1>

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
                    <div class="grid grid-cols-2 gap-4">
                        <!-- Start Date -->
                        <div>
                            <label for="startDate" class="block text-xs font-bold text-gray-700 mb-2 tracking-wider">
                                START DATE
                            </label>
                            <div class="relative">
                                <input
                                    type="date"
                                    id="startDate"
                                    wire:model="formData.start_date"
                                    class="w-full px-4 py-3 pr-10 border border-[#72d0df] rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-gray-900 bg-white"
                                    required
                                >
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
                                <input
                                    type="time"
                                    id="startTime"
                                    wire:model="formData.start_time"
                                    class="w-full px-4 py-3 pr-10 border border-[#72d0df] rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-gray-900 bg-white"
                                    required
                                >
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
                                <input
                                    type="date"
                                    id="endDate"
                                    wire:model="formData.end_date"
                                    class="w-full px-4 py-3 pr-10 border border-[#72d0df] rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-gray-900 bg-white"
                                    required
                                >
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
                                <input
                                    type="time"
                                    id="endTime"
                                    wire:model="formData.end_time"
                                    class="w-full px-4 py-3 pr-10 border border-[#72d0df] rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-gray-900 bg-white"
                                    required
                                >
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
                    <div>
                        <label for="activityDetails" class="block text-xs font-bold text-gray-700 mb-2 tracking-wider">
                            ACTIVITY DETAILS
                        </label>
                        <textarea
                            id="activityDetails"
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
            <div class="w-1/2 px-8 pt-24 pb-6">
                <div class="flex items-center justify-between mb-8">
                    <h2 class="text-3xl font-bold text-gray-800">Upcoming Activities</h2>
                    <div class="flex items-center text-[#03a1bf] cursor-pointer hover:underline">
                        <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                        Preview
                    </div>
                </div>

                <div class="space-y-4 max-h-96 overflow-y-auto">
                    @forelse($activities as $activity)
                        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 hover:shadow-md transition-shadow">
                            <div class="flex items-start justify-between">
                                <div class="flex items-center space-x-4">
                                    <div class="text-center">
                                        <div class="text-xs text-[#03a1bf] font-medium">
                                            {{ $activity['start_date_time']->format('M') }}
                                        </div>
                                        <div class="text-2xl font-bold text-gray-800">
                                            {{ $activity['start_date_time']->format('d') }}
                                        </div>
                                    </div>
                                    <div class="flex-1">
                                        <h3 class="font-semibold text-gray-800 mb-1">{{ $activity['name'] }}</h3>
                                        <p class="text-sm text-gray-600 mb-1">{{ Str::limit($activity['details'] ?? 'No details provided', 50) }}</p>
                                        <div class="flex items-center text-xs text-[#03a1bf]">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            {{ $activity['start_date_time']->format('g:i A') }}
                                        </div>
                                    </div>
                                </div>
                                <button class="text-gray-400 hover:text-gray-600">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-8">
                            <svg class="w-12 h-12 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <p class="text-gray-500">No activities scheduled yet</p>
                            <p class="text-sm text-gray-400">Create your first activity to get started</p>
                        </div>
                    @endforelse
                </div>

                @if(count($activities) > 3)
                    <div class="text-center mt-4">
                        <button class="text-[#03a1bf] hover:underline font-medium">
                            SHOW MORE
                        </button>
                    </div>
                @endif
            </div>
        </div>

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
                        >
                        <x-input-error for="formData.end_time" />
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
                        @forelse($activities as $activity)
                            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-3">
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
                                        <h3 class="font-semibold text-gray-800 text-sm mb-1">{{ $activity['name'] }}</h3>
                                        <p class="text-xs text-gray-600 mb-1">{{ Str::limit($activity['details'] ?? 'No details provided', 40) }}</p>
                                        <div class="flex items-center text-xs text-[#03a1bf]">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            {{ $activity['start_date_time']->format('g:i A') }}
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
