<?php

namespace App\Filament\Resources\UserResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Models\Community;

class CommunitiesRelationManager extends RelationManager
{
    protected static string $relationship = "communities";

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute("name")
            ->columns([
                Tables\Columns\TextColumn::make("name")
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make("city")
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make("state")
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make("pivot.role")
                    ->label("Role")
                    ->badge()
                    ->color(
                        fn(string $state): string => match ($state) {
                            "admin" => "danger",
                            "moderator" => "warning",
                            "member" => "success",
                            default => "gray",
                        }
                    ),
                Tables\Columns\TextColumn::make("pivot.joined_at")
                    ->label("Joined At")
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\IconColumn::make("pivot.is_active")
                    ->label("Active")
                    ->boolean()
                    ->trueIcon("heroicon-o-check-circle")
                    ->falseIcon("heroicon-o-x-circle"),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make("role")
                    ->options([
                        "member" => "Member",
                        "admin" => "Admin",
                        "moderator" => "Moderator",
                    ])
                    ->attribute("pivot.role"),
                Tables\Filters\Filter::make("active")->query(
                    fn(Builder $query): Builder => $query->wherePivot(
                        "is_active",
                        true
                    )
                ),
                Tables\Filters\Filter::make("inactive")->query(
                    fn(Builder $query): Builder => $query->wherePivot(
                        "is_active",
                        false
                    )
                ),
            ])
            ->headerActions([
                Tables\Actions\Action::make("joinCommunity")
                    ->label("Join Community")
                    ->icon("heroicon-o-plus")
                    ->form([
                        Forms\Components\Select::make("community_id")
                            ->label("Community")
                            ->options(function () {
                                // Get communities that the user is not already a member of
                                $existingCommunityIds = $this->ownerRecord
                                    ->communities()
                                    ->pluck("communities.id");
                                return Community::whereNotIn(
                                    "id",
                                    $existingCommunityIds
                                )->pluck("name", "id");
                            })
                            ->searchable()
                            ->required(),
                        Forms\Components\Select::make("role")
                            ->options([
                                "member" => "Member",
                                "admin" => "Admin",
                                "moderator" => "Moderator",
                            ])
                            ->default("member")
                            ->required(),
                        Forms\Components\DateTimePicker::make("joined_at")
                            ->label("Joined At")
                            ->default(now())
                            ->required(),
                        Forms\Components\Toggle::make("is_active")
                            ->label("Active")
                            ->default(true),
                    ])
                    ->action(function (array $data) {
                        $this->ownerRecord
                            ->communities()
                            ->attach($data["community_id"], [
                                "role" => $data["role"],
                                "joined_at" => $data["joined_at"],
                                "is_active" => $data["is_active"],
                            ]);
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->form([
                        Forms\Components\Select::make("role")
                            ->options([
                                "member" => "Member",
                                "admin" => "Admin",
                                "moderator" => "Moderator",
                            ])
                            ->required(),
                        Forms\Components\DateTimePicker::make("joined_at")
                            ->label("Joined At")
                            ->required(),
                        Forms\Components\Toggle::make("is_active")->label(
                            "Active"
                        ),
                    ])
                    ->fillForm(function ($record): array {
                        return [
                            "role" => $record->pivot->role,
                            "joined_at" => $record->pivot->joined_at,
                            "is_active" => $record->pivot->is_active,
                        ];
                    })
                    ->using(function ($record, array $data): void {
                        $this->ownerRecord
                            ->communities()
                            ->updateExistingPivot($record->id, [
                                "role" => $data["role"],
                                "joined_at" => $data["joined_at"],
                                "is_active" => $data["is_active"],
                            ]);
                    }),
                Tables\Actions\DetachAction::make()->label("Leave Community"),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DetachBulkAction::make()->label(
                        "Leave Communities"
                    ),
                ]),
            ]);
    }
}
