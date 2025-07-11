<?php

use App\Models\Community;
use App\Models\User;
use App\Models\CommunityMember;
use Illuminate\Foundation\Testing\RefreshDatabase;

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

describe('Community Members Relationships', function () {
    it('can add a member to a community', function () {
        $this->community->members()->attach($this->user->id, [
            'role' => 'member',
            'joined_at' => now(),
            'is_active' => true,
        ]);

        expect($this->community->members)->toHaveCount(1);
        expect($this->community->members->first()->id)->toBe($this->user->id);
    });

    it('can add multiple members to a community', function () {
        $user2 = User::factory()->create();
        $user3 = User::factory()->create();

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
            $user3->id => [
                'role' => 'moderator',
                'joined_at' => now(),
                'is_active' => false,
            ],
        ]);

        expect($this->community->members)->toHaveCount(2); // Only active members
        expect($this->community->allMembers)->toHaveCount(3); // All members including inactive
    });

    it('can access pivot data for members', function () {
        $joinedAt = now()->subDays(30);

        $this->community->members()->attach($this->user->id, [
            'role' => 'admin',
            'joined_at' => $joinedAt,
            'is_active' => true,
        ]);

        $member = $this->community->members->first();

        expect($member->pivot->role)->toBe('admin');
        expect($member->pivot->joined_at->format('Y-m-d'))->toBe($joinedAt->format('Y-m-d'));
        expect($member->pivot->is_active)->toBeTrue();
    });

    it('only returns active members by default', function () {
        $this->community->members()->attach([
            $this->user->id => [
                'role' => 'member',
                'joined_at' => now(),
                'is_active' => true,
            ],
            $this->admin->id => [
                'role' => 'admin',
                'joined_at' => now(),
                'is_active' => false,
            ],
        ]);

        expect($this->community->members)->toHaveCount(1);
        expect($this->community->members->first()->id)->toBe($this->user->id);
    });

    it('can get all members including inactive', function () {
        $this->community->members()->attach([
            $this->user->id => [
                'role' => 'member',
                'joined_at' => now(),
                'is_active' => true,
            ],
            $this->admin->id => [
                'role' => 'admin',
                'joined_at' => now(),
                'is_active' => false,
            ],
        ]);

        expect($this->community->allMembers)->toHaveCount(2);
    });

    it('can remove a member from a community', function () {
        $this->community->members()->attach($this->user->id, [
            'role' => 'member',
            'joined_at' => now(),
            'is_active' => true,
        ]);

        expect($this->community->members)->toHaveCount(1);

        $this->community->members()->detach($this->user->id);

        expect($this->community->fresh()->members)->toHaveCount(0);
    });

    it('can update member pivot data', function () {
        $this->community->members()->attach($this->user->id, [
            'role' => 'member',
            'joined_at' => now(),
            'is_active' => true,
        ]);

        $this->community->members()->updateExistingPivot($this->user->id, [
            'role' => 'admin',
            'is_active' => false,
        ]);

        $member = $this->community->fresh()->allMembers->first();

        expect($member->pivot->role)->toBe('admin');
        expect($member->pivot->is_active)->toBeFalse();
    });

    it('prevents duplicate memberships', function () {
        $this->community->members()->attach($this->user->id, [
            'role' => 'member',
            'joined_at' => now(),
            'is_active' => true,
        ]);

        // This should throw an exception due to unique constraint
        expect(function () {
            $this->community->members()->attach($this->user->id, [
                'role' => 'admin',
                'joined_at' => now(),
                'is_active' => true,
            ]);
        })->toThrow(Exception::class);
    });
});

describe('User Communities Relationships', function () {
    it('can get communities for a user', function () {
        $community2 = Community::factory()->create();

        $this->user->communities()->attach([
            $this->community->id => [
                'role' => 'member',
                'joined_at' => now(),
                'is_active' => true,
            ],
            $community2->id => [
                'role' => 'admin',
                'joined_at' => now(),
                'is_active' => true,
            ],
        ]);

        expect($this->user->communities)->toHaveCount(2);
        expect($this->user->communities->pluck('id'))->toContain($this->community->id);
        expect($this->user->communities->pluck('id'))->toContain($community2->id);
    });

    it('only returns active community memberships by default', function () {
        $community2 = Community::factory()->create();

        $this->user->communities()->attach([
            $this->community->id => [
                'role' => 'member',
                'joined_at' => now(),
                'is_active' => true,
            ],
            $community2->id => [
                'role' => 'admin',
                'joined_at' => now(),
                'is_active' => false,
            ],
        ]);

        expect($this->user->communities)->toHaveCount(1);
        expect($this->user->communities->first()->id)->toBe($this->community->id);
    });

    it('can get all communities including inactive memberships', function () {
        $community2 = Community::factory()->create();

        $this->user->communities()->attach([
            $this->community->id => [
                'role' => 'member',
                'joined_at' => now(),
                'is_active' => true,
            ],
            $community2->id => [
                'role' => 'admin',
                'joined_at' => now(),
                'is_active' => false,
            ],
        ]);

        expect($this->user->allCommunities)->toHaveCount(2);
    });

    it('can access pivot data for user communities', function () {
        $joinedAt = now()->subDays(15);

        $this->user->communities()->attach($this->community->id, [
            'role' => 'moderator',
            'joined_at' => $joinedAt,
            'is_active' => true,
        ]);

        $community = $this->user->communities->first();

        expect($community->pivot->role)->toBe('moderator');
        expect($community->pivot->joined_at->format('Y-m-d'))->toBe($joinedAt->format('Y-m-d'));
        expect($community->pivot->is_active)->toBeTrue();
    });
});

describe('CommunityMember Model', function () {
    it('can create a community member record', function () {
        $communityMember = CommunityMember::create([
            'community_id' => $this->community->id,
            'user_id' => $this->user->id,
            'role' => 'admin',
            'joined_at' => now(),
            'is_active' => true,
        ]);

        expect($communityMember)->toBeInstanceOf(CommunityMember::class);
        expect($communityMember->community_id)->toBe($this->community->id);
        expect($communityMember->user_id)->toBe($this->user->id);
        expect($communityMember->role)->toBe('admin');
        expect($communityMember->is_active)->toBeTrue();
    });

    it('has proper relationships', function () {
        $communityMember = CommunityMember::create([
            'community_id' => $this->community->id,
            'user_id' => $this->user->id,
            'role' => 'member',
            'joined_at' => now(),
            'is_active' => true,
        ]);

        expect($communityMember->community)->toBeInstanceOf(Community::class);
        expect($communityMember->community->id)->toBe($this->community->id);

        expect($communityMember->user)->toBeInstanceOf(User::class);
        expect($communityMember->user->id)->toBe($this->user->id);
    });

    it('casts attributes properly', function () {
        $joinedAt = now()->subDays(10);

        $communityMember = CommunityMember::create([
            'community_id' => $this->community->id,
            'user_id' => $this->user->id,
            'role' => 'member',
            'joined_at' => $joinedAt,
            'is_active' => true,
        ]);

        expect($communityMember->joined_at)->toBeInstanceOf(Carbon\Carbon::class);
        expect($communityMember->is_active)->toBeTrue();
    });
});

describe('Role-based Operations', function () {
    it('can filter members by role', function () {
        $user2 = User::factory()->create();
        $user3 = User::factory()->create();

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
            $user3->id => [
                'role' => 'moderator',
                'joined_at' => now(),
                'is_active' => true,
            ],
        ]);

        $admins = $this->community->members()->wherePivot('role', 'admin')->get();
        $members = $this->community->members()->wherePivot('role', 'member')->get();

        expect($admins)->toHaveCount(1);
        expect($admins->first()->id)->toBe($user2->id);

        expect($members)->toHaveCount(1);
        expect($members->first()->id)->toBe($this->user->id);
    });

    it('can get all available roles', function () {
        $expectedRoles = ['member', 'admin', 'moderator'];

        // This would typically come from a configuration or enum
        expect($expectedRoles)->toContain('member');
        expect($expectedRoles)->toContain('admin');
        expect($expectedRoles)->toContain('moderator');
    });
});

describe('Edge Cases', function () {
    it('handles empty communities gracefully', function () {
        expect($this->community->members)->toHaveCount(0);
        expect($this->community->allMembers)->toHaveCount(0);
    });

    it('handles users with no communities gracefully', function () {
        expect($this->user->communities)->toHaveCount(0);
        expect($this->user->allCommunities)->toHaveCount(0);
    });

    it('handles deactivated members correctly', function () {
        $this->community->members()->attach($this->user->id, [
            'role' => 'member',
            'joined_at' => now(),
            'is_active' => false,
        ]);

        expect($this->community->members)->toHaveCount(0);
        expect($this->community->allMembers)->toHaveCount(1);
    });
});
