<?php

use App\Enums\MaintenanceRequestCategory;
use App\Enums\MaintenanceRequestStatus;
use App\Filament\Resources\CommunityResource\Pages\EditCommunity;
use App\Filament\Resources\CommunityResource\Pages\ListCommunities;
use App\Filament\Resources\CommunityResource\RelationManagers\MembersRelationManager;
use App\Filament\Resources\MaintenanceRequestResource\Pages\ListMaintenanceRequests;
use App\Filament\Resources\UserResource\Pages\EditUser;
use App\Filament\Resources\UserResource\Pages\ListUsers;
use App\Filament\Resources\UserResource\RelationManagers\CommunitiesRelationManager;
use App\Models\Community;
use App\Models\MaintenanceRequest;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->admin = User::factory()->create([
        'name' => 'Admin User',
        'email' => 'mike@aliasproject.com', // This email has admin access
    ]);

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

    $this->actingAs($this->admin);
});

describe('Community Resource', function () {
    it('can render community list page', function () {
        Livewire::test(ListCommunities::class)
            ->assertSuccessful()
            ->assertCanSeeTableRecords([$this->community]);
    });

    it('can render community edit page', function () {
        Livewire::test(EditCommunity::class, ['record' => $this->community->getRouteKey()])
            ->assertSuccessful()
            ->assertFormSet([
                'name' => $this->community->name,
                'address' => $this->community->address,
                'city' => $this->community->city,
                'state' => $this->community->state,
                'zip' => $this->community->zip,
                'contact_name' => $this->community->contact_name,
                'phone' => $this->community->phone,
                'email' => $this->community->email,
            ]);
    });

    it('can update community details', function () {
        $newData = [
            'name' => 'Updated Community Name',
            'address' => '456 Updated Street',
            'city' => 'Updated City',
            'state' => 'Updated State',
            'zip' => '67890',
            'contact_name' => 'Jane Doe',
            'phone' => '555-5678',
            'email' => 'updated@example.com',
        ];

        Livewire::test(EditCommunity::class, ['record' => $this->community->getRouteKey()])
            ->fillForm($newData)
            ->call('save')
            ->assertHasNoFormErrors();

        $this->assertDatabaseHas('communities', $newData);
    });

    it('can search communities', function () {
        $community2 = Community::factory()->create(['name' => 'Another Community']);

        Livewire::test(ListCommunities::class)
            ->searchTable('Test Community')
            ->assertCanSeeTableRecords([$this->community])
            ->assertCanNotSeeTableRecords([$community2]);
    });

    it('can filter communities by state', function () {
        $community2 = Community::factory()->create(['state' => 'Different State']);

        Livewire::test(ListCommunities::class)
            ->filterTable('state', 'Test State')
            ->assertCanSeeTableRecords([$this->community])
            ->assertCanNotSeeTableRecords([$community2]);
    });

    it('displays member count correctly', function () {
        $this->community->members()->attach($this->user->id, [
            'role' => 'member',
            'joined_at' => now(),
            'is_active' => true,
        ]);

        Livewire::test(ListCommunities::class)
            ->assertTableColumnStateSet('members_count', '1', $this->community);
    });
});

describe('User Resource', function () {
    it('can render user list page', function () {
        Livewire::test(ListUsers::class)
            ->assertSuccessful()
            ->assertCanSeeTableRecords([$this->admin, $this->user]);
    });

    it('can render user edit page', function () {
        Livewire::test(EditUser::class, ['record' => $this->user->getRouteKey()])
            ->assertSuccessful()
            ->assertFormSet([
                'name' => $this->user->name,
                'email' => $this->user->email,
            ]);
    });

    it('can update user details', function () {
        $newData = [
            'name' => 'Updated User Name',
            'email' => 'updated@example.com',
        ];

        Livewire::test(EditUser::class, ['record' => $this->user->getRouteKey()])
            ->fillForm($newData)
            ->call('save')
            ->assertHasNoFormErrors();

        $this->assertDatabaseHas('users', $newData);
    });

    it('can search users', function () {
        Livewire::test(ListUsers::class)
            ->searchTable('Test User')
            ->assertCanSeeTableRecords([$this->user])
            ->assertCanNotSeeTableRecords([$this->admin]);
    });

    it('can filter users by verification status', function () {
        $this->user->update(['email_verified_at' => now()]);

        Livewire::test(ListUsers::class)
            ->filterTable('verified')
            ->assertCanSeeTableRecords([$this->user]);
    });

    it('displays community count correctly', function () {
        $this->user->communities()->attach($this->community->id, [
            'role' => 'member',
            'joined_at' => now(),
            'is_active' => true,
        ]);

        Livewire::test(ListUsers::class)
            ->assertTableColumnStateSet('communities_count', '1', $this->user);
    });
});

describe('Community Members Relation Manager', function () {
    it('can render members relation manager', function () {
        Livewire::test(MembersRelationManager::class, [
            'ownerRecord' => $this->community,
            'pageClass' => EditCommunity::class,
        ])
            ->assertSuccessful();
    });

    it('can add member to community', function () {
        Livewire::test(MembersRelationManager::class, [
            'ownerRecord' => $this->community,
            'pageClass' => EditCommunity::class,
        ])
            ->callAction('addMember', data: [
                'user_id' => $this->user->id,
                'role' => 'member',
                'joined_at' => now()->toDateTimeString(),
                'is_active' => true,
            ])
            ->assertHasNoActionErrors();

        $this->assertDatabaseHas('community_members', [
            'community_id' => $this->community->id,
            'user_id' => $this->user->id,
            'role' => 'member',
            'is_active' => true,
        ]);
    });

    it('can edit member details', function () {
        $this->community->members()->attach($this->user->id, [
            'role' => 'member',
            'joined_at' => now(),
            'is_active' => true,
        ]);

        Livewire::test(MembersRelationManager::class, [
            'ownerRecord' => $this->community,
            'pageClass' => EditCommunity::class,
        ])
            ->callTableAction('edit', $this->user, data: [
                'role' => 'admin',
                'joined_at' => now()->toDateTimeString(),
                'is_active' => true,
            ])
            ->assertHasNoTableActionErrors();

        $this->assertDatabaseHas('community_members', [
            'community_id' => $this->community->id,
            'user_id' => $this->user->id,
            'role' => 'admin',
            'is_active' => true,
        ]);
    });

    it('can remove member from community', function () {
        $this->community->members()->attach($this->user->id, [
            'role' => 'member',
            'joined_at' => now(),
            'is_active' => true,
        ]);

        Livewire::test(MembersRelationManager::class, [
            'ownerRecord' => $this->community,
            'pageClass' => EditCommunity::class,
        ])
            ->callTableAction('detach', $this->user)
            ->assertHasNoTableActionErrors();

        $this->assertDatabaseMissing('community_members', [
            'community_id' => $this->community->id,
            'user_id' => $this->user->id,
        ]);
    });

    it('can filter members by role', function () {
        $user2 = User::factory()->create();

        $this->community->members()->attach([
            $this->user->id => [
                'role' => 'member',
                'joined_at' => now(),
                'is_active' => true,
            ],
            $user2->id => [
                'role' => 'admin',
                'joined_at' => now(),
                'is_active' => true,
            ],
        ]);

        Livewire::test(MembersRelationManager::class, [
            'ownerRecord' => $this->community,
            'pageClass' => EditCommunity::class,
        ])
            ->filterTable('role', 'admin')
            ->assertCanSeeTableRecords([$user2])
            ->assertCanNotSeeTableRecords([$this->user]);
    });

    it('can filter members by active status', function () {
        $user2 = User::factory()->create();

        $this->community->members()->attach([
            $this->user->id => [
                'role' => 'member',
                'joined_at' => now(),
                'is_active' => true,
            ],
            $user2->id => [
                'role' => 'member',
                'joined_at' => now(),
                'is_active' => false,
            ],
        ]);

        Livewire::test(MembersRelationManager::class, [
            'ownerRecord' => $this->community,
            'pageClass' => EditCommunity::class,
        ])
            ->filterTable('active')
            ->assertCanSeeTableRecords([$this->user])
            ->assertCanNotSeeTableRecords([$user2]);
    });
});

describe('User Communities Relation Manager', function () {
    it('can render communities relation manager', function () {
        Livewire::test(CommunitiesRelationManager::class, [
            'ownerRecord' => $this->user,
            'pageClass' => EditUser::class,
        ])
            ->assertSuccessful();
    });

    it('can add user to community', function () {
        Livewire::test(CommunitiesRelationManager::class, [
            'ownerRecord' => $this->user,
            'pageClass' => EditUser::class,
        ])
            ->callAction('joinCommunity', data: [
                'community_id' => $this->community->id,
                'role' => 'member',
                'joined_at' => now()->toDateTimeString(),
                'is_active' => true,
            ])
            ->assertHasNoActionErrors();

        $this->assertDatabaseHas('community_members', [
            'community_id' => $this->community->id,
            'user_id' => $this->user->id,
            'role' => 'member',
            'is_active' => true,
        ]);
    });

    it('can edit user community membership', function () {
        $this->user->communities()->attach($this->community->id, [
            'role' => 'member',
            'joined_at' => now(),
            'is_active' => true,
        ]);

        Livewire::test(CommunitiesRelationManager::class, [
            'ownerRecord' => $this->user,
            'pageClass' => EditUser::class,
        ])
            ->callTableAction('edit', $this->community, data: [
                'role' => 'moderator',
                'joined_at' => now()->toDateTimeString(),
                'is_active' => true,
            ])
            ->assertHasNoTableActionErrors();

        $this->assertDatabaseHas('community_members', [
            'community_id' => $this->community->id,
            'user_id' => $this->user->id,
            'role' => 'moderator',
            'is_active' => true,
        ]);
    });

    it('can remove user from community', function () {
        $this->user->communities()->attach($this->community->id, [
            'role' => 'member',
            'joined_at' => now(),
            'is_active' => true,
        ]);

        Livewire::test(CommunitiesRelationManager::class, [
            'ownerRecord' => $this->user,
            'pageClass' => EditUser::class,
        ])
            ->callTableAction('detach', $this->community)
            ->assertHasNoTableActionErrors();

        $this->assertDatabaseMissing('community_members', [
            'community_id' => $this->community->id,
            'user_id' => $this->user->id,
        ]);
    });
});

describe('MaintenanceRequest Resource', function () {
    beforeEach(function () {
        $this->maintenanceRequest = MaintenanceRequest::create([
            'community_id' => $this->community->id,
            'user_id' => $this->user->id,
            'title' => 'Test Maintenance Request',
            'description' => 'Test description',
            'category' => MaintenanceRequestCategory::PLUMBING,
            'priority' => 'high',
            'status' => MaintenanceRequestStatus::PENDING,
        ]);
    });

    it('can render maintenance request list page', function () {
        Livewire::test(ListMaintenanceRequests::class)
            ->assertSuccessful()
            ->assertCanSeeTableRecords([$this->maintenanceRequest]);
    });

    it('displays enum values correctly in table', function () {
        Livewire::test(ListMaintenanceRequests::class)
            ->assertTableColumnStateSet('category', 'Plumbing', $this->maintenanceRequest)
            ->assertTableColumnStateSet('status', 'Pending', $this->maintenanceRequest);
    });

    it('can filter by community', function () {
        $community2 = Community::factory()->create();
        $request2 = MaintenanceRequest::create([
            'community_id' => $community2->id,
            'user_id' => $this->user->id,
            'title' => 'Different Community Request',
            'description' => 'Test description',
            'category' => MaintenanceRequestCategory::ELECTRICAL,
            'priority' => 'medium',
            'status' => MaintenanceRequestStatus::PENDING,
        ]);

        Livewire::test(ListMaintenanceRequests::class)
            ->filterTable('community_id', $this->community->id)
            ->assertCanSeeTableRecords([$this->maintenanceRequest])
            ->assertCanNotSeeTableRecords([$request2]);
    });

    it('can filter by status', function () {
        $request2 = MaintenanceRequest::create([
            'community_id' => $this->community->id,
            'user_id' => $this->user->id,
            'title' => 'Completed Request',
            'description' => 'Test description',
            'category' => MaintenanceRequestCategory::ELECTRICAL,
            'priority' => 'medium',
            'status' => MaintenanceRequestStatus::COMPLETED,
        ]);

        Livewire::test(ListMaintenanceRequests::class)
            ->filterTable('status', 'pending')
            ->assertCanSeeTableRecords([$this->maintenanceRequest])
            ->assertCanNotSeeTableRecords([$request2]);
    });

    it('can filter by category', function () {
        $request2 = MaintenanceRequest::create([
            'community_id' => $this->community->id,
            'user_id' => $this->user->id,
            'title' => 'Electrical Request',
            'description' => 'Test description',
            'category' => MaintenanceRequestCategory::ELECTRICAL,
            'priority' => 'medium',
            'status' => MaintenanceRequestStatus::PENDING,
        ]);

        Livewire::test(ListMaintenanceRequests::class)
            ->filterTable('category', 'plumbing')
            ->assertCanSeeTableRecords([$this->maintenanceRequest])
            ->assertCanNotSeeTableRecords([$request2]);
    });

    it('can filter by priority', function () {
        $request2 = MaintenanceRequest::create([
            'community_id' => $this->community->id,
            'user_id' => $this->user->id,
            'title' => 'Low Priority Request',
            'description' => 'Test description',
            'category' => MaintenanceRequestCategory::LANDSCAPING,
            'priority' => 'low',
            'status' => MaintenanceRequestStatus::PENDING,
        ]);

        Livewire::test(ListMaintenanceRequests::class)
            ->filterTable('priority', 'high')
            ->assertCanSeeTableRecords([$this->maintenanceRequest])
            ->assertCanNotSeeTableRecords([$request2]);
    });

    it('can filter urgent requests', function () {
        $urgentRequest = MaintenanceRequest::create([
            'community_id' => $this->community->id,
            'user_id' => $this->user->id,
            'title' => 'Urgent Request',
            'description' => 'Test description',
            'category' => MaintenanceRequestCategory::SAFETY_EMERGENCY,
            'priority' => 'urgent',
            'status' => MaintenanceRequestStatus::PENDING,
        ]);

        Livewire::test(ListMaintenanceRequests::class)
            ->filterTable('urgent')
            ->assertCanSeeTableRecords([$urgentRequest])
            ->assertCanNotSeeTableRecords([$this->maintenanceRequest]);
    });

    it('can search maintenance requests', function () {
        Livewire::test(ListMaintenanceRequests::class)
            ->searchTable('Test Maintenance')
            ->assertCanSeeTableRecords([$this->maintenanceRequest]);
    });

    it('orders by creation date by default', function () {
        $newerRequest = MaintenanceRequest::create([
            'community_id' => $this->community->id,
            'user_id' => $this->user->id,
            'title' => 'Newer Request',
            'description' => 'Test description',
            'category' => MaintenanceRequestCategory::OTHER,
            'priority' => 'medium',
            'status' => MaintenanceRequestStatus::PENDING,
            'created_at' => now()->addMinutes(1),
        ]);

        $tableData = Livewire::test(ListMaintenanceRequests::class)
            ->assertSuccessful()
            ->get('table')
            ->getRecords();

        // Should be ordered by created_at desc, so newer request should be first
        expect($tableData->first()->id)->toBe($newerRequest->id);
    });
});

describe('Form Validation', function () {
    it('validates required fields in community form', function () {
        Livewire::test(EditCommunity::class, ['record' => $this->community->getRouteKey()])
            ->fillForm([
                'name' => '',
                'address' => '',
                'city' => '',
                'state' => '',
                'zip' => '',
                'contact_name' => '',
            ])
            ->call('save')
            ->assertHasFormErrors(['name', 'address', 'city', 'state', 'zip', 'contact_name']);
    });

    it('validates required fields in user form', function () {
        Livewire::test(EditUser::class, ['record' => $this->user->getRouteKey()])
            ->fillForm([
                'name' => '',
                'email' => '',
            ])
            ->call('save')
            ->assertHasFormErrors(['name', 'email']);
    });

    it('validates email format in user form', function () {
        Livewire::test(EditUser::class, ['record' => $this->user->getRouteKey()])
            ->fillForm([
                'name' => 'Test User',
                'email' => 'invalid-email',
            ])
            ->call('save')
            ->assertHasFormErrors(['email']);
    });

    it('validates email uniqueness in user form', function () {
        $existingUser = User::factory()->create(['email' => 'existing@example.com']);

        Livewire::test(EditUser::class, ['record' => $this->user->getRouteKey()])
            ->fillForm([
                'name' => 'Test User',
                'email' => 'existing@example.com',
            ])
            ->call('save')
            ->assertHasFormErrors(['email']);
    });
});

describe('Access Control', function () {
    it('requires authentication for admin panel', function () {
        auth()->logout();

        $this->get('/admin')
            ->assertRedirect('/admin/login');
    });

    it('allows admin access for authorized users', function () {
        expect($this->admin->canAccessPanel(\Filament\Facades\Filament::getCurrentPanel()))->toBeTrue();
    });

    it('denies admin access for unauthorized users', function () {
        $regularUser = User::factory()->create(['email' => 'regular@example.com']);

        expect($regularUser->canAccessPanel(\Filament\Facades\Filament::getCurrentPanel()))->toBeFalse();
    });
});
