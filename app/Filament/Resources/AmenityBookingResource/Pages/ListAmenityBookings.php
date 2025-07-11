<?php

namespace App\Filament\Resources\AmenityBookingResource\Pages;

use App\Filament\Resources\AmenityBookingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAmenityBookings extends ListRecords
{
    protected static string $resource = AmenityBookingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
