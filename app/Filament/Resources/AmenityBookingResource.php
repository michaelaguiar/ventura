<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AmenityBookingResource\Pages;
use App\Models\AmenityBooking;
use App\Models\Community;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class AmenityBookingResource extends Resource
{
    protected static ?string $model = AmenityBooking::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar';

    protected static ?string $navigationGroup = 'Community Management';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Booking Information')
                    ->schema([
                        Forms\Components\Select::make('community_id')
                            ->label('Community')
                            ->options(Community::all()->pluck('name', 'id'))
                            ->searchable()
                            ->required(),
                        Forms\Components\Select::make('user_id')
                            ->label('User')
                            ->options(User::all()->pluck('name', 'id'))
                            ->searchable()
                            ->required(),
                        Forms\Components\TextInput::make('amenity_name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Select::make('status')
                            ->options([
                                'pending' => 'Pending',
                                'confirmed' => 'Confirmed',
                                'cancelled' => 'Cancelled',
                                'completed' => 'Completed',
                                'no_show' => 'No Show',
                            ])
                            ->required()
                            ->default('pending'),
                    ]),
                Forms\Components\Section::make('Schedule')
                    ->schema([
                        Forms\Components\DatePicker::make('booking_date')
                            ->required()
                            ->native(false),
                        Forms\Components\TimePicker::make('start_time')
                            ->required()
                            ->native(false),
                        Forms\Components\TimePicker::make('end_time')
                            ->required()
                            ->native(false)
                            ->after('start_time'),
                        Forms\Components\TextInput::make('guest_count')
                            ->numeric()
                            ->default(1)
                            ->minValue(1),
                    ]),
                Forms\Components\Section::make('Contact Information')
                    ->schema([
                        Forms\Components\TextInput::make('contact_name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('contact_phone')
                            ->tel()
                            ->maxLength(20),
                        Forms\Components\TextInput::make('contact_email')
                            ->email()
                            ->maxLength(255),
                    ]),
                Forms\Components\Section::make('Additional Information')
                    ->schema([
                        Forms\Components\Textarea::make('special_requests')
                            ->maxLength(1000)
                            ->rows(4),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('amenity_name')
                    ->label('Amenity')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('community.name')
                    ->label('Community')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->label('User')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('booking_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('start_time')
                    ->time()
                    ->sortable(),
                Tables\Columns\TextColumn::make('end_time')
                    ->time()
                    ->sortable(),
                Tables\Columns\TextColumn::make('guest_count')
                    ->label('Guests')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'confirmed' => 'success',
                        'cancelled' => 'danger',
                        'completed' => 'info',
                        'no_show' => 'gray',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('contact_name')
                    ->label('Contact')
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('contact_phone')
                    ->label('Phone')
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('community_id')
                    ->label('Community')
                    ->options(Community::all()->pluck('name', 'id'))
                    ->searchable(),
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'confirmed' => 'Confirmed',
                        'cancelled' => 'Cancelled',
                        'completed' => 'Completed',
                        'no_show' => 'No Show',
                    ]),
                Tables\Filters\Filter::make('upcoming')
                    ->query(fn (Builder $query): Builder => $query->where('booking_date', '>=', now()->toDateString()))
                    ->label('Upcoming Bookings'),
                Tables\Filters\Filter::make('past')
                    ->query(fn (Builder $query): Builder => $query->where('booking_date', '<', now()->toDateString()))
                    ->label('Past Bookings'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('booking_date', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAmenityBookings::route('/'),
            'create' => Pages\CreateAmenityBooking::route('/create'),
            'edit' => Pages\EditAmenityBooking::route('/{record}/edit'),
        ];
    }
}
