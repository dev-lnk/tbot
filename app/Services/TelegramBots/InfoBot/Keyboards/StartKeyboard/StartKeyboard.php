<?php

namespace App\Services\TelegramBots\InfoBot\Keyboards\StartKeyboard;

use App\Services\TelegramBots\InfoBot\Keyboards\OtherButtons\ButtonStylesKeyboard;
use App\Services\TelegramBots\InfoBot\Keyboards\TelegramKeyboard;
use Longman\TelegramBot\Entities\InlineKeyboard;
use Longman\TelegramBot\Entities\Keyboard;

class StartKeyboard extends TelegramKeyboard
{
    public function buildKeyboard(string $value = ''): Keyboard
    {
        return new InlineKeyboard(
            [$this->inlineButton(new ButtonAccount())],
            [$this->inlineButton(new ButtonNumberKeyboard())],
            [$this->inlineButton(new ButtonStylesKeyboard())],
        );
    }
}