<?php

namespace App\Livewire;

use App\Actions\BookAmenity as BookAmenityAction;
use App\Models\AmenityBooking;
use App\Models\Community;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class BookAmenity extends Component
{
    public $formData = [
        'amenity_name' => null,
        'booking_date' => null,
        'start_time' => null,
        'end_time' => null,
        'guest_count' => 1,
        'contact_name' => null,
        'contact_phone' => null,
        'contact_email' => null,
        'special_requests' => null,
    ];

    public $amenityBookings = [];

    public $availableAmenities = [
        'Swimming Pool',
        'Clubhouse',
        'Tennis Court',
        'Basketball Court',
        'Fitness Center',
        'BBQ Area',
        'Playground',
        'Recreation Room',
        'Picnic Area',
        'Hot Tub/Spa',
        'Community Garden',
        'Game Room',
        'Library/Reading Room',
        'Meeting Room',
        'Laundry Room',
    ];

    public $selectedBooking = null;

    public $showModal = false;

    public $showDetailsModal = false;

    public $modalPage = 1;

    public $perPage = 12;

    public $community = null;

    protected $rules = [
        'formData.amenity_name' => 'required',
        'formData.booking_date' => 'required|date|after_or_equal:today',
        'formData.start_time' => 'required',
        'formData.end_time' => 'required|after:formData.start_time',
        'formData.guest_count' => 'required|integer|min:1|max:50',
        'formData.contact_name' => 'required|max:255',
        'formData.contact_phone' => 'required|max:20',
        'formData.contact_email' => 'required|email|max:255',
        'formData.special_requests' => 'nullable|max:500',
    ];

    protected $messages = [
        'formData.amenity_name.required' => 'Please select an amenity',
        'formData.booking_date.required' => 'Booking date is required',
        'formData.booking_date.date' => 'Please enter a valid date',
        'formData.booking_date.after_or_equal' => 'Booking date must be today or later',
        'formData.start_time.required' => 'Start time is required',
        'formData.end_time.required' => 'End time is required',
        'formData.end_time.after' => 'End time must be after start time',
        'formData.guest_count.required' => 'Number of guests is required',
        'formData.guest_count.integer' => 'Number of guests must be a number',
        'formData.guest_count.min' => 'At least 1 guest is required',
        'formData.guest_count.max' => 'Maximum 50 guests allowed',
        'formData.contact_name.required' => 'Contact name is required',
        'formData.contact_name.max' => 'Contact name must be less than 255 characters',
        'formData.contact_phone.required' => 'Contact phone is required',
        'formData.contact_phone.max' => 'Contact phone must be less than 20 characters',
        'formData.contact_email.required' => 'Contact email is required',
        'formData.contact_email.email' => 'Please enter a valid email address',
        'formData.contact_email.max' => 'Contact email must be less than 255 characters',
        'formData.special_requests.max' => 'Special requests must be less than 500 characters',
    ];

    public function mount(Request $request, Community $community): void
    {
        $this->community = $community;
        $this->loadAmenityBookings();
    }

    public function loadAmenityBookings(): void
    {
        $bookings = AmenityBooking::where('community_id', $this->community->id)
            ->orderBy('booking_date', 'desc')
            ->orderBy('start_time', 'desc')
            ->get();

        $this->amenityBookings = $bookings
            ->map(function ($booking) {
                return [
                    'id' => $booking->id,
                    'amenity_name' => $booking->amenity_name,
                    'booking_date' => $booking->booking_date,
                    'start_time' => $booking->start_time,
                    'end_time' => $booking->end_time,
                    'guest_count' => $booking->guest_count,
                    'contact_name' => $booking->contact_name,
                    'contact_phone' => $booking->contact_phone,
                    'contact_email' => $booking->contact_email,
                    'special_requests' => $booking->special_requests,
                    'status' => $booking->status,
                    'created_at' => $booking->created_at,
                ];
            })
            ->toArray();
    }

    public function render()
    {
        return view('livewire.book-amenity')->layout(
            'components.layouts.blank'
        );
    }

    public function bookAmenity(): void
    {
        $this->validate();

        try {
            // Create full datetime strings
            $startDateTime =
                $this->formData['booking_date'].
                ' '.
                $this->formData['start_time'];
            $endDateTime =
                $this->formData['booking_date'].
                ' '.
                $this->formData['end_time'];

            BookAmenityAction::run(
                community: $this->community,
                user: User::find(1),
                amenityName: $this->formData['amenity_name'],
                bookingDate: $this->formData['booking_date'],
                startTime: $startDateTime,
                endTime: $endDateTime,
                guestCount: $this->formData['guest_count'],
                contactName: $this->formData['contact_name'],
                contactPhone: $this->formData['contact_phone'],
                contactEmail: $this->formData['contact_email'],
                specialRequests: $this->formData['special_requests']
            );

            // Reset form after successful creation
            $this->formData = [
                'amenity_name' => null,
                'booking_date' => null,
                'start_time' => null,
                'end_time' => null,
                'guest_count' => 1,
                'contact_name' => null,
                'contact_phone' => null,
                'contact_email' => null,
                'special_requests' => null,
            ];

            // Reload bookings from database
            $this->loadAmenityBookings();

            // Show success message
            session()->flash('message', 'Amenity booked successfully!');
        } catch (\Exception $e) {
            // Log the error for debugging
            Log::error('Error booking amenity: '.$e->getMessage());

            // Show user-friendly error message
            $this->addError(
                'general',
                'Failed to book amenity. Please try again.'
            );
        }
    }

    public function openModal(): void
    {
        $this->showModal = true;
        $this->modalPage = 1;
    }

    public function closeModal(): void
    {
        $this->showModal = false;
    }

    public function openDetailsModal($bookingId): void
    {
        $this->selectedBooking = collect($this->amenityBookings)->firstWhere(
            'id',
            $bookingId
        );
        $this->showDetailsModal = true;
    }

    public function closeDetailsModal(): void
    {
        $this->showDetailsModal = false;
        $this->selectedBooking = null;
    }

    public function getModalBookings()
    {
        $offset = ($this->modalPage - 1) * $this->perPage;

        return array_slice($this->amenityBookings, $offset, $this->perPage);
    }

    public function getTotalPages()
    {
        return ceil(count($this->amenityBookings) / $this->perPage);
    }

    public function previousPage(): void
    {
        if ($this->modalPage > 1) {
            $this->modalPage--;
        }
    }

    public function nextPage(): void
    {
        if ($this->modalPage < $this->getTotalPages()) {
            $this->modalPage++;
        }
    }

    public function getStatusColor($status): string
    {
        return match ($status) {
            'pending' => 'bg-yellow-100 text-yellow-800',
            'confirmed' => 'bg-green-100 text-green-800',
            'cancelled' => 'bg-red-100 text-red-800',
            'completed' => 'bg-blue-100 text-blue-800',
            default => 'bg-gray-100 text-gray-800',
        };
    }

    public function getTimeRange($startTime, $endTime): string
    {
        $start = \Carbon\Carbon::parse($startTime)->format('g:i A');
        $end = \Carbon\Carbon::parse($endTime)->format('g:i A');

        return $start.' - '.$end;
    }
}
