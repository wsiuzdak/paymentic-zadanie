<?php

namespace App\enum;

enum TaskStatus: string
{
    case TODO = 'TODO';
    case IN_PROGRESS = 'IN_PROGRESS';
    case DONE = 'DONE';
    case ABANDONED = 'ABANDONED';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}

