<?php

namespace App\Services\TelegramBots\InfoBot;

use App\Services\TelegramBots\InfoBot\Keyboards\AppKeyboardList;
use App\Services\TelegramBots\TelegramBot;
use Longman\TelegramBot\Exception\TelegramException;

class InfoBot extends TelegramBot
{
    /**
     * @throws TelegramException
     */
    public static function makeBot(): TelegramBot
    {
        return new static(
            config('telegram.bot_api_key'),
            config('telegram.bot_username'),
            __DIR__.'/Commands',
        );
    }

    public function setBot(): void
    {
        $this->telegram->useGetUpdatesWithoutDatabase();

        $buttons = AppKeyboardList::getAllButtons();

        foreach ($buttons as $button) {
            $this->addFunctionInCallback(new $button());
        }
    }
}