<?php

namespace App\Services\TelegramBots\InfoBot\Keyboards\OtherButtons;

use App\Services\TelegramBots\InfoBot\Entities\TelegramButton;
use App\Services\TelegramBots\InfoBot\Keyboards\StartKeyboard\StartKeyboard;
use Longman\TelegramBot\Entities\CallbackQuery;
use Longman\TelegramBot\Entities\ServerResponse;
use Longman\TelegramBot\Exception\TelegramException;
use Longman\TelegramBot\Request;

class ButtonStartKeyboard extends TelegramButton
{
    protected string $buttonKey = 'start-keyboard';

    protected string $buttonText = 'Главное меню '. '🔙';

    /**
     * @throws TelegramException
     */
    public function handle(CallbackQuery $query): ServerResponse
    {
        $keyboard = StartKeyboard::make()->getKeyboard();

        return Request::sendMessage([
            'chat_id' => $query->getMessage()->getChat()->getId(),
            'text'          => 'Главное меню',
            'reply_markup'  => $keyboard
        ]);
    }
}