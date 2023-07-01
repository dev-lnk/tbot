<?php

namespace App\Types;

enum Style: string
{
    case Real = 'real';

    case Cyberpunk = 'cyberpunk';

    case Space = 'space';

    case Mult = 'mult';

    public function name(): string
    {
        return match($this) {
            self::Real => 'Фотореализм',
            self::Cyberpunk => 'Киберпанк',
            self::Space => 'Космос',
            self::Mult => 'Мультипликация',
        };
    }
}