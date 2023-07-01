<?php

namespace App\Services\TelegramBots\InfoBot\Keyboards\StylesKeyboard;

use App\Services\TelegramBots\InfoBot\Keyboards\OtherButtons\ButtonStartKeyboard;
use App\Services\TelegramBots\InfoBot\Keyboards\TelegramKeyboard;
use Longman\TelegramBot\Entities\InlineKeyboard;
use Longman\TelegramBot\Entities\Keyboard;

class StylesKeyboard extends TelegramKeyboard
{
    public function buildKeyboard(string $value = ''): Keyboard
    {
        return new InlineKeyboard(
            [$this->inlineButton(new ButtonReal())],
            [$this->inlineButton(new ButtonCyberpunk())],
            [$this->inlineButton(new ButtonSpace())],
            [$this->inlineButton(new ButtonMult())],
            [$this->inlineButton(new ButtonAdultsOnly())],
            [$this->inlineButton(new ButtonStartKeyboard())],
        );
    }
}