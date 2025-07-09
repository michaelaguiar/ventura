<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Community extends Model
{
    protected $fillable = [
        "name",
        "address",
        "city",
        "state",
        "zip",
        "latitude",
        "longitude",
        "contact_name",
        "phone",
        "email",
        "logo_path",
    ];

    /**
     * Activities associated with the community.
     *
     * @return HasMany<Activity,Community>
     */
    public function activities(): HasMany
    {
        return $this->hasMany(Activity::class);
    }

    /**
     * Maintenance requests associated with the community.
     *
     * @return HasMany<MaintenanceRequest,Community>
     */
    public function maintenanceRequests(): HasMany
    {
        return $this->hasMany(MaintenanceRequest::class);
    }

    /**
     * Members associated with the community.
     *
     * @return HasMany<User,Community>
     */
    public function members(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
