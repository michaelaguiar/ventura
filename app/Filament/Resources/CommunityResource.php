<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CommunityResource\Pages;
use App\Models\Community;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CommunityResource extends Resource
{
    protected static ?string $model = Community::class;

    protected static ?string $navigationIcon = "heroicon-o-building-office-2";

    protected static ?string $navigationGroup = "Community Management";

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make("Community Information")->schema([
                Forms\Components\TextInput::make("name")
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make("address")
                    ->required()
                    ->maxLength(500),
                Forms\Components\Grid::make(3)->schema([
                    Forms\Components\TextInput::make("city")
                        ->required()
                        ->maxLength(100),
                    Forms\Components\TextInput::make("state")
                        ->required()
                        ->maxLength(50),
                    Forms\Components\TextInput::make("zip")
                        ->required()
                        ->maxLength(20),
                ]),
                Forms\Components\Grid::make(2)->schema([
                    Forms\Components\TextInput::make("latitude")
                        ->numeric()
                        ->step(0.0001),
                    Forms\Components\TextInput::make("longitude")
                        ->numeric()
                        ->step(0.0001),
                ]),
            ]),
            Forms\Components\Section::make("Contact Information")->schema([
                Forms\Components\TextInput::make("contact_name")
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make("phone")->tel()->maxLength(20),
                Forms\Components\TextInput::make("email")
                    ->email()
                    ->maxLength(255),
                Forms\Components\FileUpload::make("logo_path")
                    ->image()
                    ->directory("community-logos")
                    ->visibility("public"),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make("logo_path")
                    ->label("Logo")
                    ->circular()
                    ->defaultImageUrl(url("/images/default-community.png")),
                Tables\Columns\TextColumn::make("name")
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make("city")
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make("state")
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make("contact_name")
                    ->label("Contact")
                    ->searchable(),
                Tables\Columns\TextColumn::make("phone")->searchable(),
                Tables\Columns\TextColumn::make("email")->searchable(),
                Tables\Columns\TextColumn::make("members_count")
                    ->label("Members")
                    ->counts("members")
                    ->sortable(),
                Tables\Columns\TextColumn::make("created_at")
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make("updated_at")
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\Filter::make("has_logo")->query(
                    fn(Builder $query): Builder => $query->whereNotNull(
                        "logo_path"
                    )
                ),
                Tables\Filters\SelectFilter::make("state")->options(
                    function () {
                        return Community::distinct()
                            ->pluck("state", "state")
                            ->toArray();
                    }
                ),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            CommunityResource\RelationManagers\MembersRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            "index" => Pages\ListCommunities::route("/"),
            "create" => Pages\CreateCommunity::route("/create"),
            "edit" => Pages\EditCommunity::route("/{record}/edit"),
        ];
    }
}
