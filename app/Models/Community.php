<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Community extends Model
{
    protected $fillable = [
        'name',
        'address',
        'contact_name',
        'phone',
        'email',
        'logo_path',
    ];

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }

    public function maintenanceRequests()
    {
        return $this->hasMany(MaintenanceRequest::class);
    }

    public function members()
    {
        return $this->hasMany(User::class);
    }
}
