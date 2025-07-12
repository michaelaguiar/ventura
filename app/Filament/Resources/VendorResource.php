<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VendorResource\Pages;
use App\Models\Community;
use App\Models\Vendor;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class VendorResource extends Resource
{
    protected static ?string $model = Vendor::class;

    protected static ?string $navigationIcon = "heroicon-o-briefcase";

    protected static ?string $navigationGroup = "Community Management";

    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make("Vendor Information")->schema([
                Forms\Components\Select::make("community_id")
                    ->label("Community")
                    ->options(Community::all()->pluck("name", "id"))
                    ->searchable()
                    ->required(),
                Forms\Components\TextInput::make("name")
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make("category")
                    ->options([
                        "plumbing" => "Plumbing",
                        "electrical" => "Electrical",
                        "hvac" => "HVAC",
                        "landscaping" => "Landscaping",
                        "cleaning" => "Cleaning",
                        "maintenance" => "Maintenance",
                        "pest_control" => "Pest Control",
                        "security" => "Security",
                        "food_service" => "Food Service",
                        "entertainment" => "Entertainment",
                        "pool_spa" => "Pool/Spa",
                        "roofing" => "Roofing",
                        "flooring" => "Flooring",
                        "painting" => "Painting",
                        "appliance_repair" => "Appliance Repair",
                        "internet_tv" => "Internet/TV",
                        "waste_management" => "Waste Management",
                        "construction" => "Construction",
                        "automotive" => "Automotive",
                        "property_management" => "Property Management",
                        "legal_services" => "Legal Services",
                        "insurance" => "Insurance",
                        "real_estate" => "Real Estate",
                        "financial_services" => "Financial Services",
                        "healthcare" => "Healthcare",
                        "pet_services" => "Pet Services",
                        "delivery" => "Delivery",
                        "transportation" => "Transportation",
                        "other" => "Other",
                    ])
                    ->required(),
                Forms\Components\FileUpload::make("logo_path")
                    ->image()
                    ->directory("vendor-logos")
                    ->visibility("public"),
            ]),
            Forms\Components\Section::make("Contact Information")->schema([
                Forms\Components\TextInput::make("contact_name")
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make("phone")->tel()->maxLength(20),
                Forms\Components\TextInput::make("email")
                    ->email()
                    ->maxLength(255),
                Forms\Components\TextInput::make("website")
                    ->url()
                    ->maxLength(255),
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
                    ->defaultImageUrl(url("/images/default-vendor.png")),
                Tables\Columns\TextColumn::make("name")
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make("community.name")
                    ->label("Community")
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make("category")
                    ->badge()
                    ->formatStateUsing(
                        fn(string $state): string => match ($state) {
                            "plumbing" => "Plumbing",
                            "electrical" => "Electrical",
                            "hvac" => "HVAC",
                            "landscaping" => "Landscaping",
                            "cleaning" => "Cleaning",
                            "maintenance" => "Maintenance",
                            "pest_control" => "Pest Control",
                            "security" => "Security",
                            "food_service" => "Food Service",
                            "entertainment" => "Entertainment",
                            "pool_spa" => "Pool/Spa",
                            "roofing" => "Roofing",
                            "flooring" => "Flooring",
                            "painting" => "Painting",
                            "appliance_repair" => "Appliance Repair",
                            "internet_tv" => "Internet/TV",
                            "waste_management" => "Waste Management",
                            "construction" => "Construction",
                            "automotive" => "Automotive",
                            "property_management" => "Property Management",
                            "legal_services" => "Legal Services",
                            "insurance" => "Insurance",
                            "real_estate" => "Real Estate",
                            "financial_services" => "Financial Services",
                            "healthcare" => "Healthcare",
                            "pet_services" => "Pet Services",
                            "delivery" => "Delivery",
                            "transportation" => "Transportation",
                            "other" => "Other",
                            default => $state,
                        }
                    ),
                Tables\Columns\TextColumn::make("contact_name")
                    ->label("Contact")
                    ->searchable(),
                Tables\Columns\TextColumn::make("phone")->searchable(),
                Tables\Columns\TextColumn::make("email")->searchable(),
                Tables\Columns\TextColumn::make("website")
                    ->url(fn($record) => $record->website)
                    ->openUrlInNewTab()
                    ->toggleable(),
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
                Tables\Filters\SelectFilter::make("community_id")
                    ->label("Community")
                    ->options(Community::all()->pluck("name", "id"))
                    ->searchable(),
                Tables\Filters\SelectFilter::make("category")->options([
                    "plumbing" => "Plumbing",
                    "electrical" => "Electrical",
                    "hvac" => "HVAC",
                    "landscaping" => "Landscaping",
                    "cleaning" => "Cleaning",
                    "maintenance" => "Maintenance",
                    "pest_control" => "Pest Control",
                    "security" => "Security",
                    "food_service" => "Food Service",
                    "entertainment" => "Entertainment",
                    "pool_spa" => "Pool/Spa",
                    "roofing" => "Roofing",
                    "flooring" => "Flooring",
                    "painting" => "Painting",
                    "appliance_repair" => "Appliance Repair",
                    "internet_tv" => "Internet/TV",
                    "waste_management" => "Waste Management",
                    "construction" => "Construction",
                    "automotive" => "Automotive",
                    "property_management" => "Property Management",
                    "legal_services" => "Legal Services",
                    "insurance" => "Insurance",
                    "real_estate" => "Real Estate",
                    "financial_services" => "Financial Services",
                    "healthcare" => "Healthcare",
                    "pet_services" => "Pet Services",
                    "delivery" => "Delivery",
                    "transportation" => "Transportation",
                    "other" => "Other",
                ]),
                Tables\Filters\Filter::make("has_logo")
                    ->query(
                        fn(Builder $query): Builder => $query->whereNotNull(
                            "logo_path"
                        )
                    )
                    ->label("With Logo"),
                Tables\Filters\Filter::make("has_website")
                    ->query(
                        fn(Builder $query): Builder => $query->whereNotNull(
                            "website"
                        )
                    )
                    ->label("With Website"),
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
                //
            ];
    }

    public static function getPages(): array
    {
        return [
            "index" => Pages\ListVendors::route("/"),
            "create" => Pages\CreateVendor::route("/create"),
            "edit" => Pages\EditVendor::route("/{record}/edit"),
        ];
    }
}
