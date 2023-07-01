<?php

namespace App\Services\TelegramBots\InfoBot\Keyboards\NumbersKeyboard;

use App\Services\TelegramBots\InfoBot\Keyboards\OtherButtons\ButtonStartKeyboard;
use App\Services\TelegramBots\InfoBot\Keyboards\TelegramKeyboard;
use Longman\TelegramBot\Entities\InlineKeyboard;
use Longman\TelegramBot\Entities\Keyboard;

class NumbersKeyboard extends TelegramKeyboard
{
    public function buildKeyboard(string $value = ''): Keyboard
    {
        return new InlineKeyboard(
            [
                $this->inlineButton(new Button1()),
                $this->inlineButton(new Button2()),
                $this->inlineButton(new Button3()),
            ],
            [
                $this->inlineButton(new Button4()),
                $this->inlineButton(new Button5()),
                $this->inlineButton(new Button6()),
            ],
            [
                $this->inlineButton(new Button7()),
                $this->inlineButton(new Button8()),
                $this->inlineButton(new Button9()),
            ],
            [$this->inlineButton(new ButtonStartKeyboard())],
        );
    }
}