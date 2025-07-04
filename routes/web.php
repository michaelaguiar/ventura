<?php

use App\Livewire\BookAmenity;
use App\Livewire\CreateActivity;
use App\Livewire\CreateCommunity;
use App\Livewire\CreateVendor;
use App\Livewire\MaintenanceRequest;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;

Route::get('/', CreateCommunity::class)->name('home');
Route::get('/community/{community}/activities', CreateActivity::class)->name(
    'community.activities'
);
Route::get('/community/{community}/vendors', CreateVendor::class)->name(
    'community.vendors'
);
Route::get(
    '/community/{community}/maintenance',
    MaintenanceRequest::class
)->name('community.maintenance');
Route::get('/community/{community}/amenities', BookAmenity::class)->name(
    'community.amenities'
);

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name(
        'settings.appearance'
    );
});

require __DIR__.'/auth.php';
