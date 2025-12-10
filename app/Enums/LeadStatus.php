<?php

namespace App\Enums;

enum LeadStatus: string
{
    case NEW = 'new';
    case CONTACTED = 'contacted';
    case UNQUALIFIED = 'unqualified';
    case IN_PROGRESS = 'in_progress';
    case CONVERTED = 'converted';
    case CLOSED = 'closed';

    public function label(): string
    {
        return match($this) {
            self::NEW => 'New',
            self::CONTACTED => 'Contacted',
            self::UNQUALIFIED => 'Unqualified',
            self::IN_PROGRESS => 'In Progress',
            self::CONVERTED => 'Converted',
            self::CLOSED => 'Closed',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}