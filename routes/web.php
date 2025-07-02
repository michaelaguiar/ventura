<?php

use App\Livewire\CreateActivity;
use App\Livewire\CreateCommunity;
use App\Livewire\CreateVendor;
use App\Livewire\MaintenanceRequest;
use App\Livewire\BookAmenity;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// })->name('home');

Route::get("/", CreateCommunity::class)->name("home");
Route::get("/activity", CreateActivity::class)->name("activity");
Route::get("/vendor", CreateVendor::class)->name("vendor");
Route::get("/maintenance", MaintenanceRequest::class)->name("maintenance");
Route::get("/amenity", BookAmenity::class)->name("amenity");

Route::view("dashboard", "dashboard")
    ->middleware(["auth", "verified"])
    ->name("dashboard");

Route::middleware(["auth"])->group(function () {
    Route::redirect("settings", "settings/profile");

    Route::get("settings/profile", Profile::class)->name("settings.profile");
    Route::get("settings/password", Password::class)->name("settings.password");
    Route::get("settings/appearance", Appearance::class)->name(
        "settings.appearance"
    );
});

require __DIR__ . "/auth.php";
