<?php

use App\Models\Community;
use App\Models\User;
use App\Models\MaintenanceRequest;
use App\Enums\MaintenanceRequestCategory;
use App\Enums\MaintenanceRequestStatus;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->community = Community::factory()->create([
        'name' => 'Test Community',
        'address' => '123 Test Street',
        'city' => 'Test City',
        'state' => 'Test State',
        'zip' => '12345',
        'contact_name' => 'John Doe',
        'phone' => '555-1234',
        'email' => 'test@example.com',
    ]);

    $this->user = User::factory()->create([
        'name' => 'Test User',
        'email' => 'user@example.com',
    ]);

    $this->admin = User::factory()->create([
        'name' => 'Admin User',
        'email' => 'admin@example.com',
    ]);
});

describe('MaintenanceRequest Model', function () {
    it('can create a maintenance request', function () {
        $maintenanceRequest = MaintenanceRequest::create([
            'community_id' => $this->community->id,
            'user_id' => $this->user->id,
            'title' => 'Leaky Faucet',
            'description' => 'The kitchen faucet is leaking water constantly.',
            'category' => MaintenanceRequestCategory::PLUMBING,
            'priority' => 'high',
            'status' => MaintenanceRequestStatus::PENDING,
        ]);

        expect($maintenanceRequest)->toBeInstanceOf(MaintenanceRequest::class);
        expect($maintenanceRequest->title)->toBe('Leaky Faucet');
        expect($maintenanceRequest->category)->toBe(MaintenanceRequestCategory::PLUMBING);
        expect($maintenanceRequest->status)->toBe(MaintenanceRequestStatus::PENDING);
    });

    it('has proper relationships', function () {
        $maintenanceRequest = MaintenanceRequest::create([
            'community_id' => $this->community->id,
            'user_id' => $this->user->id,
            'title' => 'Test Request',
            'description' => 'Test description',
            'category' => MaintenanceRequestCategory::ELECTRICAL,
            'priority' => 'medium',
            'status' => MaintenanceRequestStatus::PENDING,
        ]);

        expect($maintenanceRequest->community)->toBeInstanceOf(Community::class);
        expect($maintenanceRequest->community->id)->toBe($this->community->id);

        expect($maintenanceRequest->user)->toBeInstanceOf(User::class);
        expect($maintenanceRequest->user->id)->toBe($this->user->id);
    });

    it('casts enums properly', function () {
        $maintenanceRequest = MaintenanceRequest::create([
            'community_id' => $this->community->id,
            'user_id' => $this->user->id,
            'title' => 'Test Request',
            'description' => 'Test description',
            'category' => MaintenanceRequestCategory::HVAC,
            'priority' => 'low',
            'status' => MaintenanceRequestStatus::IN_PROGRESS,
        ]);

        expect($maintenanceRequest->category)->toBeInstanceOf(MaintenanceRequestCategory::class);
        expect($maintenanceRequest->category)->toBe(MaintenanceRequestCategory::HVAC);

        expect($maintenanceRequest->status)->toBeInstanceOf(MaintenanceRequestStatus::class);
        expect($maintenanceRequest->status)->toBe(MaintenanceRequestStatus::IN_PROGRESS);
    });

    it('handles photos array properly', function () {
        $photos = ['photo1.jpg', 'photo2.jpg'];

        $maintenanceRequest = MaintenanceRequest::create([
            'community_id' => $this->community->id,
            'user_id' => $this->user->id,
            'title' => 'Test Request',
            'description' => 'Test description',
            'category' => MaintenanceRequestCategory::OTHER,
            'priority' => 'medium',
            'status' => MaintenanceRequestStatus::PENDING,
            'photos' => $photos,
        ]);

        expect($maintenanceRequest->photos)->toBeArray();
        expect($maintenanceRequest->photos)->toHaveCount(2);
        expect($maintenanceRequest->photos)->toContain('photo1.jpg');
        expect($maintenanceRequest->photos)->toContain('photo2.jpg');
    });
});

describe('MaintenanceRequest Enums', function () {
    it('has all required category cases', function () {
        $expectedCategories = [
            'plumbing', 'electrical', 'hvac', 'appliances', 'structural',
            'landscaping', 'cleaning', 'pest_control', 'security', 'pool_spa',
            'common_areas', 'roofing', 'flooring', 'painting', 'doors_windows',
            'lighting', 'garbage_recycling', 'parking', 'fencing', 'playground',
            'clubhouse', 'laundry', 'internet_cable', 'safety_emergency',
            'accessibility', 'other'
        ];

        $actualCategories = array_map(fn($case) => $case->value, MaintenanceRequestCategory::cases());

        foreach ($expectedCategories as $category) {
            expect($actualCategories)->toContain($category);
        }
    });

    it('has all required status cases', function () {
        $expectedStatuses = [
            'pending', 'in_progress', 'completed', 'cancelled', 'on_hold', 'requires_approval'
        ];

        $actualStatuses = array_map(fn($case) => $case->value, MaintenanceRequestStatus::cases());

        foreach ($expectedStatuses as $status) {
            expect($actualStatuses)->toContain($status);
        }
    });

    it('category labels are properly formatted', function () {
        expect(MaintenanceRequestCategory::PLUMBING->label())->toBe('Plumbing');
        expect(MaintenanceRequestCategory::ELECTRICAL->label())->toBe('Electrical');
        expect(MaintenanceRequestCategory::HVAC->label())->toBe('HVAC');
        expect(MaintenanceRequestCategory::PEST_CONTROL->label())->toBe('Pest Control');
        expect(MaintenanceRequestCategory::POOL_SPA->label())->toBe('Pool/Spa');
        expect(MaintenanceRequestCategory::DOORS_WINDOWS->label())->toBe('Doors/Windows');
        expect(MaintenanceRequestCategory::SAFETY_EMERGENCY->label())->toBe('Safety/Emergency');
    });

    it('status labels are properly formatted', function () {
        expect(MaintenanceRequestStatus::PENDING->label())->toBe('Pending');
        expect(MaintenanceRequestStatus::IN_PROGRESS->label())->toBe('In Progress');
        expect(MaintenanceRequestStatus::COMPLETED->label())->toBe('Completed');
        expect(MaintenanceRequestStatus::CANCELLED->label())->toBe('Cancelled');
        expect(MaintenanceRequestStatus::ON_HOLD->label())->toBe('On Hold');
        expect(MaintenanceRequestStatus::REQUIRES_APPROVAL->label())->toBe('Requires Approval');
    });

    it('category descriptions are available', function () {
        expect(MaintenanceRequestCategory::PLUMBING->description())->toContain('Plumbing issues');
        expect(MaintenanceRequestCategory::ELECTRICAL->description())->toContain('Electrical problems');
        expect(MaintenanceRequestCategory::HVAC->description())->toContain('Heating, ventilation');
        expect(MaintenanceRequestCategory::SECURITY->description())->toContain('Security system');
    });

    it('category priority mapping works', function () {
        expect(MaintenanceRequestCategory::SAFETY_EMERGENCY->priority())->toBe('urgent');
        expect(MaintenanceRequestCategory::PLUMBING->priority())->toBe('high');
        expect(MaintenanceRequestCategory::ELECTRICAL->priority())->toBe('high');
        expect(MaintenanceRequestCategory::APPLIANCES->priority())->toBe('medium');
        expect(MaintenanceRequestCategory::LANDSCAPING->priority())->toBe('low');
    });

    it('can get categories by priority', function () {
        $urgentCategories = MaintenanceRequestCategory::getByPriority('urgent');
        $highCategories = MaintenanceRequestCategory::getByPriority('high');
        $lowCategories = MaintenanceRequestCategory::getByPriority('low');

        expect($urgentCategories)->toContain(MaintenanceRequestCategory::SAFETY_EMERGENCY);
        expect($highCategories)->toContain(MaintenanceRequestCategory::PLUMBING);
        expect($highCategories)->toContain(MaintenanceRequestCategory::ELECTRICAL);
        expect($lowCategories)->toContain(MaintenanceRequestCategory::LANDSCAPING);
    });
});

describe('MaintenanceRequest Queries', function () {
    beforeEach(function () {
        // Create test requests with different statuses and categories
        MaintenanceRequest::create([
            'community_id' => $this->community->id,
            'user_id' => $this->user->id,
            'title' => 'Urgent Plumbing',
            'description' => 'Burst pipe',
            'category' => MaintenanceRequestCategory::PLUMBING,
            'priority' => 'urgent',
            'status' => MaintenanceRequestStatus::PENDING,
        ]);

        MaintenanceRequest::create([
            'community_id' => $this->community->id,
            'user_id' => $this->user->id,
            'title' => 'Electrical Issue',
            'description' => 'Outlet not working',
            'category' => MaintenanceRequestCategory::ELECTRICAL,
            'priority' => 'high',
            'status' => MaintenanceRequestStatus::IN_PROGRESS,
        ]);

        MaintenanceRequest::create([
            'community_id' => $this->community->id,
            'user_id' => $this->admin->id,
            'title' => 'Landscaping',
            'description' => 'Trim bushes',
            'category' => MaintenanceRequestCategory::LANDSCAPING,
            'priority' => 'low',
            'status' => MaintenanceRequestStatus::COMPLETED,
        ]);
    });

    it('can filter by status', function () {
        $pendingRequests = MaintenanceRequest::where('status', MaintenanceRequestStatus::PENDING)->get();
        $completedRequests = MaintenanceRequest::where('status', MaintenanceRequestStatus::COMPLETED)->get();

        expect($pendingRequests)->toHaveCount(1);
        expect($pendingRequests->first()->title)->toBe('Urgent Plumbing');

        expect($completedRequests)->toHaveCount(1);
        expect($completedRequests->first()->title)->toBe('Landscaping');
    });

    it('can filter by category', function () {
        $plumbingRequests = MaintenanceRequest::where('category', MaintenanceRequestCategory::PLUMBING)->get();
        $electricalRequests = MaintenanceRequest::where('category', MaintenanceRequestCategory::ELECTRICAL)->get();

        expect($plumbingRequests)->toHaveCount(1);
        expect($plumbingRequests->first()->title)->toBe('Urgent Plumbing');

        expect($electricalRequests)->toHaveCount(1);
        expect($electricalRequests->first()->title)->toBe('Electrical Issue');
    });

    it('can filter by priority', function () {
        $urgentRequests = MaintenanceRequest::where('priority', 'urgent')->get();
        $lowRequests = MaintenanceRequest::where('priority', 'low')->get();

        expect($urgentRequests)->toHaveCount(1);
        expect($urgentRequests->first()->title)->toBe('Urgent Plumbing');

        expect($lowRequests)->toHaveCount(1);
        expect($lowRequests->first()->title)->toBe('Landscaping');
    });

    it('can filter by community', function () {
        $community2 = Community::factory()->create();

        MaintenanceRequest::create([
            'community_id' => $community2->id,
            'user_id' => $this->user->id,
            'title' => 'Different Community Request',
            'description' => 'Test',
            'category' => MaintenanceRequestCategory::OTHER,
            'priority' => 'medium',
            'status' => MaintenanceRequestStatus::PENDING,
        ]);

        $community1Requests = MaintenanceRequest::where('community_id', $this->community->id)->get();
        $community2Requests = MaintenanceRequest::where('community_id', $community2->id)->get();

        expect($community1Requests)->toHaveCount(3);
        expect($community2Requests)->toHaveCount(1);
        expect($community2Requests->first()->title)->toBe('Different Community Request');
    });

    it('can filter by user', function () {
        $userRequests = MaintenanceRequest::where('user_id', $this->user->id)->get();
        $adminRequests = MaintenanceRequest::where('user_id', $this->admin->id)->get();

        expect($userRequests)->toHaveCount(2);
        expect($adminRequests)->toHaveCount(1);
        expect($adminRequests->first()->title)->toBe('Landscaping');
    });

    it('can search by title', function () {
        $searchResults = MaintenanceRequest::where('title', 'like', '%Plumbing%')->get();

        expect($searchResults)->toHaveCount(1);
        expect($searchResults->first()->title)->toBe('Urgent Plumbing');
    });

    it('can order by creation date', function () {
        $requests = MaintenanceRequest::orderBy('created_at', 'desc')->get();

        expect($requests)->toHaveCount(3);
        expect($requests->first()->title)->toBe('Landscaping'); // Last created
    });
});

describe('MaintenanceRequest Validation', function () {
    it('requires essential fields', function () {
        expect(function () {
            MaintenanceRequest::create([
                'title' => 'Test',
                // Missing required fields
            ]);
        })->toThrow(Exception::class);
    });

    it('validates category enum', function () {
        $request = MaintenanceRequest::create([
            'community_id' => $this->community->id,
            'user_id' => $this->user->id,
            'title' => 'Test Request',
            'description' => 'Test description',
            'category' => MaintenanceRequestCategory::PLUMBING,
            'priority' => 'medium',
            'status' => MaintenanceRequestStatus::PENDING,
        ]);

        expect($request->category)->toBe(MaintenanceRequestCategory::PLUMBING);
    });

    it('validates status enum', function () {
        $request = MaintenanceRequest::create([
            'community_id' => $this->community->id,
            'user_id' => $this->user->id,
            'title' => 'Test Request',
            'description' => 'Test description',
            'category' => MaintenanceRequestCategory::OTHER,
            'priority' => 'medium',
            'status' => MaintenanceRequestStatus::IN_PROGRESS,
        ]);

        expect($request->status)->toBe(MaintenanceRequestStatus::IN_PROGRESS);
    });
});

describe('MaintenanceRequest Updates', function () {
    beforeEach(function () {
        $this->maintenanceRequest = MaintenanceRequest::create([
            'community_id' => $this->community->id,
            'user_id' => $this->user->id,
            'title' => 'Test Request',
            'description' => 'Test description',
            'category' => MaintenanceRequestCategory::PLUMBING,
            'priority' => 'medium',
            'status' => MaintenanceRequestStatus::PENDING,
        ]);
    });

    it('can update status', function () {
        $this->maintenanceRequest->update([
            'status' => MaintenanceRequestStatus::IN_PROGRESS,
        ]);

        expect($this->maintenanceRequest->fresh()->status)->toBe(MaintenanceRequestStatus::IN_PROGRESS);
    });

    it('can update priority', function () {
        $this->maintenanceRequest->update([
            'priority' => 'urgent',
        ]);

        expect($this->maintenanceRequest->fresh()->priority)->toBe('urgent');
    });

    it('can update category', function () {
        $this->maintenanceRequest->update([
            'category' => MaintenanceRequestCategory::ELECTRICAL,
        ]);

        expect($this->maintenanceRequest->fresh()->category)->toBe(MaintenanceRequestCategory::ELECTRICAL);
    });

    it('can add photos', function () {
        $photos = ['photo1.jpg', 'photo2.jpg'];

        $this->maintenanceRequest->update([
            'photos' => $photos,
        ]);

        expect($this->maintenanceRequest->fresh()->photos)->toBe($photos);
    });
});

describe('Edge Cases', function () {
    it('handles null photos gracefully', function () {
        $request = MaintenanceRequest::create([
            'community_id' => $this->community->id,
            'user_id' => $this->user->id,
            'title' => 'Test Request',
            'description' => 'Test description',
            'category' => MaintenanceRequestCategory::OTHER,
            'priority' => 'medium',
            'status' => MaintenanceRequestStatus::PENDING,
            'photos' => null,
        ]);

        expect($request->photos)->toBeNull();
    });

    it('handles empty photos array', function () {
        $request = MaintenanceRequest::create([
            'community_id' => $this->community->id,
            'user_id' => $this->user->id,
            'title' => 'Test Request',
            'description' => 'Test description',
            'category' => MaintenanceRequestCategory::OTHER,
            'priority' => 'medium',
            'status' => MaintenanceRequestStatus::PENDING,
            'photos' => [],
        ]);

        expect($request->photos)->toBeArray();
        expect($request->photos)->toHaveCount(0);
    });

    it('handles long descriptions', function () {
        $longDescription = str_repeat('This is a very long description. ', 50);

        $request = MaintenanceRequest::create([
            'community_id' => $this->community->id,
            'user_id' => $this->user->id,
            'title' => 'Test Request',
            'description' => $longDescription,
            'category' => MaintenanceRequestCategory::OTHER,
            'priority' => 'medium',
            'status' => MaintenanceRequestStatus::PENDING,
        ]);

        expect($request->description)->toBe($longDescription);
    });

    it('handles special characters in title and description', function () {
        $specialTitle = 'Test Request with Special Characters: !@#$%^&*()';
        $specialDescription = 'Description with émojis 🔧 and ñ characters';

        $request = MaintenanceRequest::create([
            'community_id' => $this->community->id,
            'user_id' => $this->user->id,
            'title' => $specialTitle,
            'description' => $specialDescription,
            'category' => MaintenanceRequestCategory::OTHER,
            'priority' => 'medium',
            'status' => MaintenanceRequestStatus::PENDING,
        ]);

        expect($request->title)->toBe($specialTitle);
        expect($request->description)->toBe($specialDescription);
    });
});
