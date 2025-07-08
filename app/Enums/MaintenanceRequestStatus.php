<?php

namespace App\Enums;

enum MaintenanceRequestStatus: string
{
    case PENDING = 'pending';
    case IN_PROGRESS = 'in_progress';
    case COMPLETED = 'completed';
    case CANCELLED = 'cancelled';
    case ON_HOLD = 'on_hold';
    case REQUIRES_APPROVAL = 'requires_approval';

    public function label(): string
    {
        return match ($this) {
            self::PENDING => 'Pending',
            self::IN_PROGRESS => 'In Progress',
            self::COMPLETED => 'Completed',
            self::CANCELLED => 'Cancelled',
            self::ON_HOLD => 'On Hold',
            self::REQUIRES_APPROVAL => 'Requires Approval',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::PENDING => 'bg-yellow-100 text-yellow-800',
            self::IN_PROGRESS => 'bg-blue-100 text-blue-800',
            self::COMPLETED => 'bg-green-100 text-green-800',
            self::CANCELLED => 'bg-red-100 text-red-800',
            self::ON_HOLD => 'bg-orange-100 text-orange-800',
            self::REQUIRES_APPROVAL => 'bg-purple-100 text-purple-800',
        };
    }

    public static function getOptions(): array
    {
        return array_map(fn ($case) => [
            'value' => $case->value,
            'label' => $case->label(),
        ], self::cases());
    }
}
