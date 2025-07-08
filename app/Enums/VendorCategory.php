<?php

namespace App\Enums;

enum VendorCategory: string
{
    case PLUMBING = 'plumbing';
    case ELECTRICAL = 'electrical';
    case HVAC = 'hvac';
    case LANDSCAPING = 'landscaping';
    case CLEANING = 'cleaning';
    case MAINTENANCE = 'maintenance';
    case PEST_CONTROL = 'pest_control';
    case SECURITY = 'security';
    case FOOD_SERVICE = 'food_service';
    case ENTERTAINMENT = 'entertainment';
    case POOL_SPA = 'pool_spa';
    case ROOFING = 'roofing';
    case FLOORING = 'flooring';
    case PAINTING = 'painting';
    case APPLIANCE_REPAIR = 'appliance_repair';
    case INTERNET_TV = 'internet_tv';
    case WASTE_MANAGEMENT = 'waste_management';
    case CONSTRUCTION = 'construction';
    case AUTOMOTIVE = 'automotive';
    case PROPERTY_MANAGEMENT = 'property_management';
    case LEGAL_SERVICES = 'legal_services';
    case INSURANCE = 'insurance';
    case REAL_ESTATE = 'real_estate';
    case FINANCIAL_SERVICES = 'financial_services';
    case HEALTHCARE = 'healthcare';
    case PET_SERVICES = 'pet_services';
    case DELIVERY = 'delivery';
    case TRANSPORTATION = 'transportation';
    case OTHER = 'other';

    public function label(): string
    {
        return match($this) {
            self::PLUMBING => 'Plumbing',
            self::ELECTRICAL => 'Electrical',
            self::HVAC => 'HVAC',
            self::LANDSCAPING => 'Landscaping',
            self::CLEANING => 'Cleaning',
            self::MAINTENANCE => 'Maintenance',
            self::PEST_CONTROL => 'Pest Control',
            self::SECURITY => 'Security',
            self::FOOD_SERVICE => 'Food Service',
            self::ENTERTAINMENT => 'Entertainment',
            self::POOL_SPA => 'Pool/Spa',
            self::ROOFING => 'Roofing',
            self::FLOORING => 'Flooring',
            self::PAINTING => 'Painting',
            self::APPLIANCE_REPAIR => 'Appliance Repair',
            self::INTERNET_TV => 'Internet/TV',
            self::WASTE_MANAGEMENT => 'Waste Management',
            self::CONSTRUCTION => 'Construction',
            self::AUTOMOTIVE => 'Automotive',
            self::PROPERTY_MANAGEMENT => 'Property Management',
            self::LEGAL_SERVICES => 'Legal Services',
            self::INSURANCE => 'Insurance',
            self::REAL_ESTATE => 'Real Estate',
            self::FINANCIAL_SERVICES => 'Financial Services',
            self::HEALTHCARE => 'Healthcare',
            self::PET_SERVICES => 'Pet Services',
            self::DELIVERY => 'Delivery',
            self::TRANSPORTATION => 'Transportation',
            self::OTHER => 'Other',
        };
    }

    public function description(): string
    {
        return match($this) {
            self::PLUMBING => 'Plumbing services and repairs',
            self::ELECTRICAL => 'Electrical services and repairs',
            self::HVAC => 'Heating, ventilation, and air conditioning',
            self::LANDSCAPING => 'Landscaping and groundskeeping',
            self::CLEANING => 'Cleaning and janitorial services',
            self::MAINTENANCE => 'General maintenance and handyman services',
            self::PEST_CONTROL => 'Pest control and extermination',
            self::SECURITY => 'Security systems and services',
            self::FOOD_SERVICE => 'Food and catering services',
            self::ENTERTAINMENT => 'Entertainment and event services',
            self::POOL_SPA => 'Pool and spa maintenance',
            self::ROOFING => 'Roofing services and repairs',
            self::FLOORING => 'Flooring installation and repair',
            self::PAINTING => 'Painting and decorating services',
            self::APPLIANCE_REPAIR => 'Appliance repair and maintenance',
            self::INTERNET_TV => 'Internet and television services',
            self::WASTE_MANAGEMENT => 'Waste management and disposal',
            self::CONSTRUCTION => 'Construction and renovation',
            self::AUTOMOTIVE => 'Automotive services and repairs',
            self::PROPERTY_MANAGEMENT => 'Property management services',
            self::LEGAL_SERVICES => 'Legal services and consultation',
            self::INSURANCE => 'Insurance services',
            self::REAL_ESTATE => 'Real estate services',
            self::FINANCIAL_SERVICES => 'Financial and banking services',
            self::HEALTHCARE => 'Healthcare and medical services',
            self::PET_SERVICES => 'Pet care and veterinary services',
            self::DELIVERY => 'Delivery and courier services',
            self::TRANSPORTATION => 'Transportation services',
            self::OTHER => 'Other services',
        };
    }

    public static function getOptions(): array
    {
        return array_map(fn($case) => [
            'value' => $case->value,
            'label' => $case->label(),
            'description' => $case->description(),
        ], self::cases());
    }

    public static function getLabels(): array
    {
        return array_map(fn($case) => $case->label(), self::cases());
    }
}
