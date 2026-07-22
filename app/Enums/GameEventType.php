<?php

namespace App\Enums;

enum GameEventType: string
{
    case Goal = 'goal';
    case RedCard = 'red card';
    case YellowCard = 'yellow card';
    case Save = 'save';

    /**
     * @return list<string>
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
