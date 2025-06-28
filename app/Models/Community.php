<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Community extends Model
{
    protected $fillable = ["name", "address", "phone", "email", "logo_path"];

    public function maintenanceRequests()
    {
        return $this->hasMany(MaintenanceRequest::class);
    }

    public function members()
    {
        return $this->hasMany(User::class);
    }
}
