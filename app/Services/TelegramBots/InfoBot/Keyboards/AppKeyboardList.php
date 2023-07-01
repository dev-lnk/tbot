<?php

namespace App\Services\TelegramBots\InfoBot\Keyboards;

use App\Services\TelegramBots\InfoBot\Keyboards\ImageKeyboard\ImageKeyboard;
use App\Services\TelegramBots\InfoBot\Keyboards\NumbersKeyboard\NumbersKeyboard;
use App\Services\TelegramBots\InfoBot\Keyboards\StartKeyboard\StartKeyboard;
use App\Services\TelegramBots\InfoBot\Keyboards\StylesKeyboard\StylesKeyboard;

class AppKeyboardList
{
    private array $keyboards = [
        StartKeyboard::class,
        NumbersKeyboard::class,
        StylesKeyboard::class,
        ImageKeyboard::class,
    ];

    /**
     * Get all buttons from keyboards
     *
     * @return array
     */
    public static function getAllButtons(): array
    {
        $keyboardObj = new static();
        $buttons = [];
        foreach ($keyboardObj->keyboards as $item) {

            $keyboard = new $item();

            if(!$keyboard instanceof TelegramKeyboard) {
                continue;
            }

            $buttons = array_merge($buttons, $keyboard->getButtons());
        }

        return $buttons;
    }
}
