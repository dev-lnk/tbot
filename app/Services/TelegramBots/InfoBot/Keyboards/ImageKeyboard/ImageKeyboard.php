<?php

namespace App\Services\TelegramBots\InfoBot\Keyboards\ImageKeyboard;

use App\Services\TelegramBots\InfoBot\Keyboards\OtherButtons\ButtonStylesKeyboard;
use App\Services\TelegramBots\InfoBot\Keyboards\TelegramKeyboard;
use Longman\TelegramBot\Entities\InlineKeyboard;
use Longman\TelegramBot\Entities\Keyboard;

class ImageKeyboard extends TelegramKeyboard
{
    public function buildKeyboard(string $value = ''): Keyboard
    {
        return new InlineKeyboard(
            [$this->inlineButton(new ButtonLandscape($value))],
            [$this->inlineButton(new ButtonMan($value))],
            [$this->inlineButton(new ButtonGirl($value))],
            [$this->inlineButton(new ButtonStylesKeyboard())],
        );
    }
}