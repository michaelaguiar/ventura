<?php

namespace App\Enums;

enum MaintenanceRequestCategory: string
{
    case PLUMBING = 'plumbing';
    case ELECTRICAL = 'electrical';
    case HVAC = 'hvac';
    case APPLIANCES = 'appliances';
    case STRUCTURAL = 'structural';
    case LANDSCAPING = 'landscaping';
    case CLEANING = 'cleaning';
    case PEST_CONTROL = 'pest_control';
    case SECURITY = 'security';
    case POOL_SPA = 'pool_spa';
    case COMMON_AREAS = 'common_areas';
    case ROOFING = 'roofing';
    case FLOORING = 'flooring';
    case PAINTING = 'painting';
    case DOORS_WINDOWS = 'doors_windows';
    case LIGHTING = 'lighting';
    case GARBAGE_RECYCLING = 'garbage_recycling';
    case PARKING = 'parking';
    case FENCING = 'fencing';
    case PLAYGROUND = 'playground';
    case CLUBHOUSE = 'clubhouse';
    case LAUNDRY = 'laundry';
    case INTERNET_CABLE = 'internet_cable';
    case SAFETY_EMERGENCY = 'safety_emergency';
    case ACCESSIBILITY = 'accessibility';
    case OTHER = 'other';

    public function label(): string
    {
        return match($this) {
            self::PLUMBING => 'Plumbing',
            self::ELECTRICAL => 'Electrical',
            self::HVAC => 'HVAC',
            self::APPLIANCES => 'Appliances',
            self::STRUCTURAL => 'Structural',
            self::LANDSCAPING => 'Landscaping',
            self::CLEANING => 'Cleaning',
            self::PEST_CONTROL => 'Pest Control',
            self::SECURITY => 'Security',
            self::POOL_SPA => 'Pool/Spa',
            self::COMMON_AREAS => 'Common Areas',
            self::ROOFING => 'Roofing',
            self::FLOORING => 'Flooring',
            self::PAINTING => 'Painting',
            self::DOORS_WINDOWS => 'Doors/Windows',
            self::LIGHTING => 'Lighting',
            self::GARBAGE_RECYCLING => 'Garbage/Recycling',
            self::PARKING => 'Parking',
            self::FENCING => 'Fencing',
            self::PLAYGROUND => 'Playground',
            self::CLUBHOUSE => 'Clubhouse',
            self::LAUNDRY => 'Laundry',
            self::INTERNET_CABLE => 'Internet/Cable',
            self::SAFETY_EMERGENCY => 'Safety/Emergency',
            self::ACCESSIBILITY => 'Accessibility',
            self::OTHER => 'Other',
        };
    }

    public function description(): string
    {
        return match($this) {
            self::PLUMBING => 'Plumbing issues, leaks, clogs, and repairs',
            self::ELECTRICAL => 'Electrical problems, outlets, and wiring',
            self::HVAC => 'Heating, ventilation, and air conditioning issues',
            self::APPLIANCES => 'Appliance repairs and maintenance',
            self::STRUCTURAL => 'Structural issues and building repairs',
            self::LANDSCAPING => 'Landscaping and grounds maintenance',
            self::CLEANING => 'Cleaning and janitorial issues',
            self::PEST_CONTROL => 'Pest control and extermination needs',
            self::SECURITY => 'Security system and access issues',
            self::POOL_SPA => 'Pool and spa maintenance and repairs',
            self::COMMON_AREAS => 'Common area maintenance and issues',
            self::ROOFING => 'Roofing problems and repairs',
            self::FLOORING => 'Flooring issues and repairs',
            self::PAINTING => 'Painting and touch-up needs',
            self::DOORS_WINDOWS => 'Door and window repairs',
            self::LIGHTING => 'Lighting issues and replacements',
            self::GARBAGE_RECYCLING => 'Garbage and recycling issues',
            self::PARKING => 'Parking lot and garage maintenance',
            self::FENCING => 'Fencing repairs and maintenance',
            self::PLAYGROUND => 'Playground equipment and safety',
            self::CLUBHOUSE => 'Clubhouse maintenance and repairs',
            self::LAUNDRY => 'Laundry facility issues',
            self::INTERNET_CABLE => 'Internet and cable connectivity issues',
            self::SAFETY_EMERGENCY => 'Safety concerns and emergency repairs',
            self::ACCESSIBILITY => 'Accessibility and ADA compliance issues',
            self::OTHER => 'Other maintenance requests',
        };
    }

    public function priority(): string
    {
        return match($this) {
            self::SAFETY_EMERGENCY => 'urgent',
            self::PLUMBING => 'high',
            self::ELECTRICAL => 'high',
            self::HVAC => 'high',
            self::SECURITY => 'high',
            self::STRUCTURAL => 'high',
            self::APPLIANCES => 'medium',
            self::DOORS_WINDOWS => 'medium',
            self::LIGHTING => 'medium',
            self::POOL_SPA => 'medium',
            self::ACCESSIBILITY => 'medium',
            self::ROOFING => 'medium',
            self::FLOORING => 'medium',
            self::FENCING => 'medium',
            self::PLAYGROUND => 'medium',
            self::CLUBHOUSE => 'medium',
            self::LAUNDRY => 'medium',
            self::INTERNET_CABLE => 'medium',
            self::LANDSCAPING => 'low',
            self::CLEANING => 'low',
            self::PEST_CONTROL => 'low',
            self::PAINTING => 'low',
            self::GARBAGE_RECYCLING => 'low',
            self::PARKING => 'low',
            self::COMMON_AREAS => 'low',
            self::OTHER => 'low',
        };
    }

    public static function getOptions(): array
    {
        return array_map(fn($case) => [
            'value' => $case->value,
            'label' => $case->label(),
            'description' => $case->description(),
            'priority' => $case->priority(),
        ], self::cases());
    }

    public static function getLabels(): array
    {
        return array_map(fn($case) => $case->label(), self::cases());
    }

    public static function getByPriority(string $priority): array
    {
        return array_filter(self::cases(), fn($case) => $case->priority() === $priority);
    }
}
