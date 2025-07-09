<div class="flex justify-center w-full bg-gradient-to-t from-[#27aac4] to-white mt-[-50px]">
    <!-- Main Content Container -->
    <div class="max-w-screen-xl w-full">

        <!-- Desktop Layout - Side by Side -->
        <div class="hidden lg:flex relative min-h-[750px]" style="">
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

            <!-- Left Side - Form Section -->
            <div class="flex flex-col px-8 pt-24 pb-6 z-2 min-w-sm">
                <h1 class="text-2xl font-bold text-gray-800 mb-8">Book Amenity</h1>

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
                <form wire:submit="bookAmenity" class="space-y-4 max-w-sm">
                    <!-- Amenity Selection -->
                    <div>
                        <label for="amenitySelect" class="block text-xs font-bold text-gray-700 mb-2 tracking-wider">
                            SELECT AMENITY
                        </label>
                        <div class="relative">
                            <select
                                id="amenitySelect"
                                wire:model="formData.amenity_name"
                                class="w-full px-4 py-3 pr-10 border border-[#72d0df] rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-gray-900 bg-white appearance-none"
                                required
                            >
                                <option value="">Select Amenity</option>
                                @foreach($availableAmenities as $amenity)
                                    <option value="{{ $amenity }}">{{ $amenity }}</option>
                                @endforeach
                            </select>
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-[#03a1bf]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </div>
                        <x-input-error for="formData.amenity_name" />
                    </div>

                    <!-- Booking Date -->
                    <div>
                        <label for="bookingDate" class="block text-xs font-bold text-gray-700 mb-2 tracking-wider">
                            BOOKING DATE
                        </label>
                        <input
                            type="date"
                            id="bookingDate"
                            wire:model="formData.booking_date"
                            min="{{ date('Y-m-d') }}"
                            class="w-full px-4 py-3 border border-[#72d0df] rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-gray-900 bg-white"
                            required
                        >
                        <x-input-error for="formData.booking_date" />
                    </div>

                    <!-- Time Selection -->
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="startTime" class="block text-xs font-bold text-gray-700 mb-2 tracking-wider">
                                START TIME
                            </label>
                            <input
                                type="time"
                                id="startTime"
                                wire:model="formData.start_time"
                                class="w-full px-4 py-3 border border-[#72d0df] rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-gray-900 bg-white"
                                required
                            >
                            <x-input-error for="formData.start_time" />
                        </div>
                        <div>
                            <label for="endTime" class="block text-xs font-bold text-gray-700 mb-2 tracking-wider">
                                END TIME
                            </label>
                            <input
                                type="time"
                                id="endTime"
                                wire:model="formData.end_time"
                                class="w-full px-4 py-3 border border-[#72d0df] rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-gray-900 bg-white"
                                required
                            >
                            <x-input-error for="formData.end_time" />
                        </div>
                    </div>

                    <!-- Guest Count -->
                    <div>
                        <label for="guestCount" class="block text-xs font-bold text-gray-700 mb-2 tracking-wider">
                            NUMBER OF GUESTS
                        </label>
                        <input
                            type="number"
                            id="guestCount"
                            wire:model="formData.guest_count"
                            min="1"
                            max="50"
                            class="w-full px-4 py-3 border border-[#72d0df] rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-gray-900 bg-white"
                            required
                        >
                        <x-input-error for="formData.guest_count" />
                    </div>

                    <!-- Contact Information -->
                    <div>
                        <label for="contactName" class="block text-xs font-bold text-gray-700 mb-2 tracking-wider">
                            CONTACT NAME
                        </label>
                        <input
                            type="text"
                            id="contactName"
                            wire:model="formData.contact_name"
                            placeholder="Your Name"
                            class="w-full px-4 py-3 border border-[#72d0df] rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-gray-900 bg-white"
                            required
                        >
                        <x-input-error for="formData.contact_name" />
                    </div>

                    <div>
                        <label for="contactPhone" class="block text-xs font-bold text-gray-700 mb-2 tracking-wider">
                            CONTACT PHONE
                        </label>
                        <x-alias::phone-input id="phone" class="w-full px-4 py-3 border border-[#72d0df] rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-gray-900 bg-white" name="phone" wire:model="formData.contact_phone" placeholder="555-123-4567" />

                        <x-input-error for="formData.contact_phone" />
                    </div>

                    <div>
                        <label for="contactEmail" class="block text-xs font-bold text-gray-700 mb-2 tracking-wider">
                            CONTACT EMAIL
                        </label>
                        <input
                            type="email"
                            id="contactEmail"
                            wire:model="formData.contact_email"
                            placeholder="your.email@example.com"
                            class="w-full px-4 py-3 border border-[#72d0df] rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-gray-900 bg-white"
                            required
                        >
                        <x-input-error for="formData.contact_email" />
                    </div>

                    <!-- Special Requests -->
                    <div>
                        <label for="specialRequests" class="block text-xs font-bold text-gray-700 mb-2 tracking-wider">
                            SPECIAL REQUESTS (OPTIONAL)
                        </label>
                        <textarea
                            id="specialRequests"
                            wire:model="formData.special_requests"
                            placeholder="Any special requests or requirements"
                            rows="3"
                            class="w-full px-4 py-3 border border-[#72d0df] rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-gray-900 bg-white resize-none"
                        ></textarea>
                        <x-input-error for="formData.special_requests" />
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-4">
                        <button
                            type="submit"
                            class="bg-[#03a1bf] text-white px-8 py-3 rounded-lg cursor-pointer hover:bg-[#027a8f] focus:outline-none focus:ring-2 focus:ring-blue-500 flex items-center font-medium"
                            wire:loading.attr="disabled"
                            wire:loading.class="opacity-50 cursor-not-allowed"
                        >
                            <span wire:loading.remove>Book Amenity</span>
                            <span wire:loading>Booking...</span>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Right Side - Bookings List -->
            <div class="w-[500px] px-8 pt-24 pb-6 max-w-md z-2 ml-auto">
                <div class="flex items-center justify-between mb-8">
                    <h2 class="text-2xl font-bold text-gray-800">Recent Bookings</h2>
                </div>

                <div class="grid grid-cols-1 gap-2">
                    @forelse(array_slice($amenityBookings, 0, 6) as $booking)
                        <div class="bg-gray-100 rounded-lg p-3 hover:bg-gray-200 transition-colors max-w-sm cursor-pointer" wire:click="openDetailsModal({{ $booking['id'] }})">
                            <div class="flex items-start space-x-3">
                                <div class="flex-shrink-0">
                                    <div class="w-12 h-12 bg-[#03a1bf] rounded-lg flex items-center justify-center">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <h4 class="font-semibold text-gray-800 mb-1 text-sm">{{ $booking['amenity_name'] }}</h4>
                                    <div class="flex items-center justify-between mb-1">
                                        <span class="text-xs text-gray-600">{{ \Carbon\Carbon::parse($booking['booking_date'])->format('M j, Y') }}</span>
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium {{ $this->getStatusColor($booking['status']) }}">
                                            {{ ucfirst($booking['status']) }}
                                        </span>
                                    </div>
                                    <div class="flex items-center justify-between text-xs text-gray-500">
                                        <span>{{ $this->getTimeRange($booking['start_time'], $booking['end_time']) }}</span>
                                        <span>{{ $booking['guest_count'] }} guest{{ $booking['guest_count'] != 1 ? 's' : '' }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-8">
                            <svg class="w-12 h-12 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <p class="text-gray-500">No bookings yet</p>
                            <p class="text-sm text-gray-400">Book your first amenity to get started</p>
                        </div>
                    @endforelse
                </div>

                @if(count($amenityBookings) > 6)
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

        <!-- All Bookings Modal -->
        @if($showModal)
            <div class="fixed inset-0 z-50 flex items-center justify-center" style="background-color: rgba(0, 0, 0, 0.3);" wire:click="closeModal">
                <div class="bg-white rounded-lg shadow-xl max-w-4xl w-full mx-4 max-h-[80vh] overflow-hidden" wire:click.stop>
                    <!-- Modal Header -->
                    <div class="flex items-center justify-between p-6 border-b">
                        <h3 class="text-2xl font-bold text-gray-800">All Bookings</h3>
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
                            @foreach($this->getModalBookings() as $booking)
                                <div class="bg-gray-50 rounded-lg p-4 hover:bg-gray-100 transition-colors cursor-pointer" wire:click="openDetailsModal({{ $booking['id'] }})">
                                    <div class="flex items-start space-x-4">
                                        <div class="flex-shrink-0">
                                            <div class="w-16 h-16 bg-[#03a1bf] rounded-lg flex items-center justify-center">
                                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="flex-1">
                                            <h4 class="font-semibold text-gray-800 mb-2">{{ $booking['amenity_name'] }}</h4>
                                            <div class="flex items-center justify-between mb-2">
                                                <span class="text-sm text-gray-600">{{ \Carbon\Carbon::parse($booking['booking_date'])->format('M j, Y') }}</span>
                                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium {{ $this->getStatusColor($booking['status']) }}">
                                                    {{ ucfirst($booking['status']) }}
                                                </span>
                                            </div>
                                            <div class="flex items-center justify-between text-sm text-gray-500">
                                                <span>{{ $this->getTimeRange($booking['start_time'], $booking['end_time']) }}</span>
                                                <span>{{ $booking['guest_count'] }} guest{{ $booking['guest_count'] != 1 ? 's' : '' }}</span>
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
                            <span class="text-sm text-gray-600">{{ count($amenityBookings) }} total bookings</span>
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
        @if($showDetailsModal && $selectedBooking)
            <div class="fixed inset-0 z-50 flex items-center justify-center" style="background-color: rgba(0, 0, 0, 0.3);" wire:click="closeDetailsModal">
                <div class="bg-white rounded-lg shadow-xl max-w-2xl w-full mx-4 max-h-[80vh] overflow-hidden" wire:click.stop>
                    <!-- Modal Header -->
                    <div class="flex items-center justify-between p-6 border-b">
                        <div>
                            <h3 class="text-xl font-bold text-gray-800">{{ $selectedBooking['amenity_name'] }}</h3>
                            <div class="flex items-center space-x-2 mt-1">
                                <span class="text-sm text-gray-600">{{ \Carbon\Carbon::parse($selectedBooking['booking_date'])->format('F j, Y') }}</span>
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium {{ $this->getStatusColor($selectedBooking['status']) }}">
                                    {{ ucfirst($selectedBooking['status']) }}
                                </span>
                            </div>
                        </div>
                        <button
                            wire:click="closeDetailsModal"
                            class="text-gray-400 hover:text-gray-600"
                        >
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>

                    <!-- Modal Body -->
                    <div class="p-6 overflow-y-auto" style="max-height: 60vh;">
                        <div class="space-y-4">
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <h4 class="font-semibold text-gray-800 mb-2">Time</h4>
                                    <p class="text-gray-600">{{ $this->getTimeRange($selectedBooking['start_time'], $selectedBooking['end_time']) }}</p>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-800 mb-2">Guests</h4>
                                    <p class="text-gray-600">{{ $selectedBooking['guest_count'] }} guest{{ $selectedBooking['guest_count'] != 1 ? 's' : '' }}</p>
                                </div>
                            </div>

                            <div>
                                <h4 class="font-semibold text-gray-800 mb-2">Contact Information</h4>
                                <div class="space-y-1">
                                    <p class="text-gray-600">{{ $selectedBooking['contact_name'] }}</p>
                                    <p class="text-gray-600">{{ $selectedBooking['contact_phone'] }}</p>
                                    <p class="text-gray-600">{{ $selectedBooking['contact_email'] }}</p>
                                </div>
                            </div>

                            @if($selectedBooking['special_requests'])
                                <div>
                                    <h4 class="font-semibold text-gray-800 mb-2">Special Requests</h4>
                                    <p class="text-gray-600">{{ $selectedBooking['special_requests'] }}</p>
                                </div>
                            @endif

                            <div>
                                <h4 class="font-semibold text-gray-800 mb-2">Booked</h4>
                                <p class="text-gray-600">{{ \Carbon\Carbon::parse($selectedBooking['created_at'])->format('F j, Y \a\t g:i A') }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Footer -->
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

        <!-- Mobile/Tablet Layout - Stacked -->
        <div class="lg:hidden">
            <!-- Form Section -->
            <div class="px-8 pt-12 pb-6">
                <h1 class="text-2xl font-bold text-gray-800 mb-6">Book Amenity</h1>

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
                <form wire:submit="bookAmenity" class="space-y-4 max-w-sm mx-auto">
                    <!-- Amenity Selection -->
                    <div>
                        <label for="amenitySelectMobile" class="block text-xs font-bold text-gray-700 mb-2 tracking-wider">
                            SELECT AMENITY
                        </label>
                        <select
                            id="amenitySelectMobile"
                            wire:model="formData.amenity_name"
                            class="w-full px-4 py-3 border border-[#72d0df] rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-gray-900 bg-white"
                            required
                        >
                            <option value="">Select Amenity</option>
                            @foreach($availableAmenities as $amenity)
                                <option value="{{ $amenity }}">{{ $amenity }}</option>
                            @endforeach
                        </select>
                        <x-input-error for="formData.amenity_name" />
                    </div>

                    <!-- Booking Date -->
                    <div>
                        <label for="bookingDateMobile" class="block text-xs font-bold text-gray-700 mb-2 tracking-wider">
                            BOOKING DATE
                        </label>
                        <input
                            type="date"
                            id="bookingDateMobile"
                            wire:model="formData.booking_date"
                            min="{{ date('Y-m-d') }}"
                            class="w-full px-4 py-3 border border-[#72d0df] rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-gray-900 bg-white"
                            required
                        >
                        <x-input-error for="formData.booking_date" />
                    </div>

                    <!-- Time Selection -->
                    <div class="grid grid-cols-2 gap-4">
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
                    </div>

                    <!-- Guest Count -->
                    <div>
                        <label for="guestCountMobile" class="block text-xs font-bold text-gray-700 mb-2 tracking-wider">
                            NUMBER OF GUESTS
                        </label>
                        <input
                            type="number"
                            id="guestCountMobile"
                            wire:model="formData.guest_count"
                            min="1"
                            max="50"
                            class="w-full px-4 py-3 border border-[#72d0df] rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-gray-900 bg-white"
                            required
                        >
                        <x-input-error for="formData.guest_count" />
                    </div>

                    <!-- Contact Information -->
                    <div>
                        <label for="contactNameMobile" class="block text-xs font-bold text-gray-700 mb-2 tracking-wider">
                            CONTACT NAME
                        </label>
                        <input
                            type="text"
                            id="contactNameMobile"
                            wire:model="formData.contact_name"
                            placeholder="Your Name"
                            class="w-full px-4 py-3 border border-[#72d0df] rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-gray-900 bg-white"
                            required
                        >
                        <x-input-error for="formData.contact_name" />
                    </div>

                    <div>
                        <label for="contactPhoneMobile" class="block text-xs font-bold text-gray-700 mb-2 tracking-wider">
                            CONTACT PHONE
                        </label>
                        <x-alias::phone-input id="phone" class="w-full px-4 py-3 border border-[#72d0df] rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-gray-900 bg-white" name="phone" wire:model="formData.contact_phone" placeholder="Phone" />
                        <!-- <input
                            type="tel"
                            id="contactPhoneMobile"
                            wire:model="formData.contact_phone"
                            placeholder="(555) 123-4567"
                            class="w-full px-4 py-3 border border-[#72d0df] rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-gray-900 bg-white"
                            required
                        > -->
                        <x-input-error for="formData.contact_phone" />
                    </div>

                    <div>
                        <label for="contactEmailMobile" class="block text-xs font-bold text-gray-700 mb-2 tracking-wider">
                            CONTACT EMAIL
                        </label>
                        <input
                            type="email"
                            id="contactEmailMobile"
                            wire:model="formData.contact_email"
                            placeholder="your.email@example.com"
                            class="w-full px-4 py-3 border border-[#72d0df] rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-gray-900 bg-white"
                            required
                        >
                        <x-input-error for="formData.contact_email" />
                    </div>

                    <!-- Special Requests -->
                    <div>
                        <label for="specialRequestsMobile" class="block text-xs font-bold text-gray-700 mb-2 tracking-wider">
                            SPECIAL REQUESTS (OPTIONAL)
                        </label>
                        <textarea
                            id="specialRequestsMobile"
                            wire:model="formData.special_requests"
                            placeholder="Any special requests or requirements"
                            rows="3"
                            class="w-full px-4 py-3 border border-[#72d0df] rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-gray-900 bg-white resize-none"
                        ></textarea>
                        <x-input-error for="formData.special_requests" />
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-4">
                        <button
                            type="submit"
                            class="w-full bg-[#03a1bf] text-white px-8 py-3 rounded-lg cursor-pointer hover:bg-[#027a8f] focus:outline-none focus:ring-2 focus:ring-blue-500 flex items-center justify-center font-medium"
                            wire:loading.attr="disabled"
                            wire:loading.class="opacity-50 cursor-not-allowed"
                        >
                            <span wire:loading.remove>Book Amenity</span>
                            <span wire:loading>Booking...</span>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Bookings List Section -->
            <div class="px-8 pb-6">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-bold text-gray-800">Recent Bookings</h2>
                </div>

                <div class="space-y-3">
                    @forelse($amenityBookings as $booking)
                        <div class="bg-gray-100 rounded-lg p-4 hover:bg-gray-200 transition-colors cursor-pointer" wire:click="openDetailsModal({{ $booking['id'] }})">
                            <div class="flex items-start space-x-3">
                                <div class="flex-shrink-0">
                                    <div class="w-12 h-12 bg-[#03a1bf] rounded-lg flex items-center justify-center">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <h4 class="font-semibold text-gray-800 mb-1">{{ $booking['amenity_name'] }}</h4>
                                    <div class="flex flex-col space-y-1 mb-2">
                                        <div class="flex items-center justify-between">
                                            <span class="text-sm text-gray-600">{{ \Carbon\Carbon::parse($booking['booking_date'])->format('M j, Y') }}</span>
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium {{ $this->getStatusColor($booking['status']) }}">
                                                {{ ucfirst($booking['status']) }}
                                            </span>
                                        </div>
                                        <div class="flex items-center justify-between text-sm text-gray-500">
                                            <span>{{ $this->getTimeRange($booking['start_time'], $booking['end_time']) }}</span>
                                            <span>{{ $booking['guest_count'] }} guest{{ $booking['guest_count'] != 1 ? 's' : '' }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-8">
                            <svg class="w-12 h-12 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <p class="text-gray-500">No bookings yet</p>
                            <p class="text-sm text-gray-400">Book your first amenity to get started</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
