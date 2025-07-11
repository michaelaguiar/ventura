<?php

namespace Database\Factories;

use App\Models\MaintenanceRequest;
use App\Models\Community;
use App\Models\User;
use App\Enums\MaintenanceRequestCategory;
use App\Enums\MaintenanceRequestStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MaintenanceRequest>
 */
class MaintenanceRequestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $category = fake()->randomElement(MaintenanceRequestCategory::cases());

        return [
            'community_id' => Community::factory(),
            'user_id' => User::factory(),
            'title' => fake()->sentence(3),
            'description' => fake()->paragraph(),
            'category' => $category,
            'priority' => fake()->randomElement(['low', 'medium', 'high', 'urgent']),
            'status' => fake()->randomElement(MaintenanceRequestStatus::cases()),
            'photos' => null,
        ];
    }

    /**
     * Indicate that the maintenance request is pending.
     */
    public function pending(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => MaintenanceRequestStatus::PENDING,
        ]);
    }

    /**
     * Indicate that the maintenance request is in progress.
     */
    public function inProgress(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => MaintenanceRequestStatus::IN_PROGRESS,
        ]);
    }

    /**
     * Indicate that the maintenance request is completed.
     */
    public function completed(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => MaintenanceRequestStatus::COMPLETED,
        ]);
    }

    /**
     * Indicate that the maintenance request is urgent.
     */
    public function urgent(): static
    {
        return $this->state(fn (array $attributes) => [
            'priority' => 'urgent',
            'category' => MaintenanceRequestCategory::SAFETY_EMERGENCY,
        ]);
    }

    /**
     * Indicate that the maintenance request is high priority.
     */
    public function highPriority(): static
    {
        return $this->state(fn (array $attributes) => [
            'priority' => 'high',
        ]);
    }

    /**
     * Indicate that the maintenance request is low priority.
     */
    public function lowPriority(): static
    {
        return $this->state(fn (array $attributes) => [
            'priority' => 'low',
        ]);
    }

    /**
     * Indicate that the maintenance request has photos.
     */
    public function withPhotos(): static
    {
        return $this->state(fn (array $attributes) => [
            'photos' => [
                'maintenance-photos/' . fake()->uuid() . '.jpg',
                'maintenance-photos/' . fake()->uuid() . '.jpg',
                'maintenance-photos/' . fake()->uuid() . '.jpg',
            ],
        ]);
    }

    /**
     * Create a maintenance request with a specific category.
     */
    public function category(MaintenanceRequestCategory $category): static
    {
        return $this->state(fn (array $attributes) => [
            'category' => $category,
        ]);
    }

    /**
     * Create a plumbing maintenance request.
     */
    public function plumbing(): static
    {
        return $this->state(fn (array $attributes) => [
            'category' => MaintenanceRequestCategory::PLUMBING,
            'title' => fake()->randomElement([
                'Leaky Faucet',
                'Clogged Drain',
                'Running Toilet',
                'Low Water Pressure',
                'Pipe Leak',
            ]),
            'description' => fake()->randomElement([
                'The kitchen faucet is dripping constantly.',
                'The bathroom drain is completely blocked.',
                'The toilet keeps running after flushing.',
                'Water pressure is very low in the shower.',
                'There is a visible leak under the sink.',
            ]),
            'priority' => 'high',
        ]);
    }

    /**
     * Create an electrical maintenance request.
     */
    public function electrical(): static
    {
        return $this->state(fn (array $attributes) => [
            'category' => MaintenanceRequestCategory::ELECTRICAL,
            'title' => fake()->randomElement([
                'Outlet Not Working',
                'Light Switch Broken',
                'Circuit Breaker Tripping',
                'Flickering Lights',
                'Power Outage',
            ]),
            'description' => fake()->randomElement([
                'The outlet in the kitchen is not working.',
                'The light switch in the bedroom is broken.',
                'The circuit breaker keeps tripping.',
                'The lights are flickering in the living room.',
                'There is no power in the entire unit.',
            ]),
            'priority' => 'high',
        ]);
    }

    /**
     * Create an HVAC maintenance request.
     */
    public function hvac(): static
    {
        return $this->state(fn (array $attributes) => [
            'category' => MaintenanceRequestCategory::HVAC,
            'title' => fake()->randomElement([
                'Air Conditioning Not Working',
                'Heating System Broken',
                'Thermostat Malfunction',
                'Strange HVAC Noises',
                'Poor Air Quality',
            ]),
            'description' => fake()->randomElement([
                'The air conditioning is not cooling properly.',
                'The heating system is not working at all.',
                'The thermostat is not responding to changes.',
                'The HVAC system is making strange noises.',
                'The air quality seems poor with musty odors.',
            ]),
            'priority' => 'high',
        ]);
    }

    /**
     * Create a landscaping maintenance request.
     */
    public function landscaping(): static
    {
        return $this->state(fn (array $attributes) => [
            'category' => MaintenanceRequestCategory::LANDSCAPING,
            'title' => fake()->randomElement([
                'Lawn Needs Mowing',
                'Tree Trimming Required',
                'Weed Control',
                'Sprinkler System Issue',
                'Dead Plants Removal',
            ]),
            'description' => fake()->randomElement([
                'The grass is overgrown and needs mowing.',
                'The tree branches are blocking the walkway.',
                'Weeds are taking over the garden area.',
                'The sprinkler system is not working properly.',
                'Several plants have died and need removal.',
            ]),
            'priority' => 'low',
        ]);
    }

    /**
     * Create a safety emergency maintenance request.
     */
    public function safetyEmergency(): static
    {
        return $this->state(fn (array $attributes) => [
            'category' => MaintenanceRequestCategory::SAFETY_EMERGENCY,
            'title' => fake()->randomElement([
                'Gas Leak Detected',
                'Broken Window',
                'Loose Handrail',
                'Smoke Detector Not Working',
                'Structural Damage',
            ]),
            'description' => fake()->randomElement([
                'There is a strong gas smell in the kitchen.',
                'The living room window is cracked and unsafe.',
                'The stairway handrail is loose and dangerous.',
                'The smoke detector is not responding to tests.',
                'There appears to be structural damage to the ceiling.',
            ]),
            'priority' => 'urgent',
        ]);
    }

    /**
     * Create a maintenance request for a specific community.
     */
    public function forCommunity(Community $community): static
    {
        return $this->state(fn (array $attributes) => [
            'community_id' => $community->id,
        ]);
    }

    /**
     * Create a maintenance request for a specific user.
     */
    public function forUser(User $user): static
    {
        return $this->state(fn (array $attributes) => [
            'user_id' => $user->id,
        ]);
    }
}
