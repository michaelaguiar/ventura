<?php

namespace App\Actions;

use App\Enums\MaintenanceRequestCategory;
use App\Enums\MaintenanceRequestStatus;
use App\Models\Community;
use App\Models\MaintenanceRequest;
use App\Models\User;

class CreateMaintenanceRequest
{
    /**
     * Create a new maintenance request
     */
    public static function run(
        Community $community,
        ?User $user,
        string $title,
        string $description,
        string $priority,
        MaintenanceRequestCategory $category,
        array $photos = []
    ): MaintenanceRequest {
        return MaintenanceRequest::create([
            "community_id" => $community->id,
            "user_id" => $user?->id,
            "title" => $title,
            "description" => $description,
            "priority" => $priority,
            "category" => $category,
            "status" => MaintenanceRequestStatus::PENDING,
            "photos" => $photos,
        ]);
    }
}
