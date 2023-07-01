<?php

namespace App\Services\TelegramBots\InfoBot\Traits;

use App\Types\Style;

trait ImageSelector
{
    public function selectImage(string $path, Style $style): string
    {
        return match ($style) {
            Style::Real => storage_path("app/public/images/$path/real.png"),
            Style::Cyberpunk => storage_path("app/public/images/$path/cyberpunk.png"),
            Style::Space => storage_path("app/public/images/$path/space.png"),
            Style::Mult => storage_path("app/public/images/$path/mult.png"),
        };
    }
}