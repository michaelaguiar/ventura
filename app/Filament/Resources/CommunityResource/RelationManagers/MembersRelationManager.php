<?php

namespace App\Filament\Resources\CommunityResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Models\User;

class MembersRelationManager extends RelationManager
{
    protected static string $relationship = "members";

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute("name")
            ->columns([
                Tables\Columns\TextColumn::make("name")
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make("email")
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
                Tables\Actions\Action::make("addMember")
                    ->label("Add Member")
                    ->icon("heroicon-o-plus")
                    ->form([
                        Forms\Components\Select::make("user_id")
                            ->label("User")
                            ->options(function () {
                                // Get users who are not already members of this community
                                $existingMemberIds = $this->ownerRecord
                                    ->members()
                                    ->pluck("users.id");
                                return User::whereNotIn(
                                    "id",
                                    $existingMemberIds
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
                            ->members()
                            ->attach($data["user_id"], [
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
                            ->members()
                            ->updateExistingPivot($record->id, [
                                "role" => $data["role"],
                                "joined_at" => $data["joined_at"],
                                "is_active" => $data["is_active"],
                            ]);
                    }),
                Tables\Actions\DetachAction::make()->label("Remove Member"),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DetachBulkAction::make()->label(
                        "Remove Members"
                    ),
                ]),
            ]);
    }
}
