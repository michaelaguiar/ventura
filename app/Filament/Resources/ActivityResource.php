<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ActivityResource\Pages;
use App\Models\Activity;
use App\Models\Community;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ActivityResource extends Resource
{
    protected static ?string $model = Activity::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';

    protected static ?string $navigationGroup = 'Community Management';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Activity Information')
                    ->schema([
                        Forms\Components\Select::make('community_id')
                            ->label('Community')
                            ->options(Community::all()->pluck('name', 'id'))
                            ->searchable()
                            ->required(),
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Textarea::make('details')
                            ->maxLength(1000)
                            ->rows(4),
                        Forms\Components\TextInput::make('location')
                            ->maxLength(255),
                    ]),
                Forms\Components\Section::make('Schedule')
                    ->schema([
                        Forms\Components\DateTimePicker::make('start_date_time')
                            ->required()
                            ->native(false),
                        Forms\Components\DateTimePicker::make('end_date_time')
                            ->required()
                            ->native(false)
                            ->after('start_date_time'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('community.name')
                    ->label('Community')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('location')
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('start_date_time')
                    ->label('Start Date')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('end_date_time')
                    ->label('End Date')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('details')
                    ->limit(50)
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
                Tables\Filters\Filter::make('upcoming')
                    ->query(fn (Builder $query): Builder => $query->where('start_date_time', '>=', now()))
                    ->label('Upcoming Activities'),
                Tables\Filters\Filter::make('past')
                    ->query(fn (Builder $query): Builder => $query->where('end_date_time', '<', now()))
                    ->label('Past Activities'),
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
            ->defaultSort('start_date_time', 'desc');
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
            'index' => Pages\ListActivities::route('/'),
            'create' => Pages\CreateActivity::route('/create'),
            'edit' => Pages\EditActivity::route('/{record}/edit'),
        ];
    }
}
