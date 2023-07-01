<?php

namespace App\Services\TelegramBots\InfoBot\Keyboards\StartKeyboard;

use App\Services\TelegramBots\InfoBot\Entities\TelegramButton;
use App\Services\TelegramBots\InfoBot\Keyboards\NumbersKeyboard\NumbersKeyboard;
use Longman\TelegramBot\Entities\CallbackQuery;
use Longman\TelegramBot\Entities\ServerResponse;
use Longman\TelegramBot\Exception\TelegramException;
use Longman\TelegramBot\Request;

class ButtonNumberKeyboard extends TelegramButton
{
    protected string $buttonKey = 'numbers-button';

    protected string $buttonText = 'Пример цифровой клавиатуры';

    /**
     * @throws TelegramException
     */
    public function handle(CallbackQuery $query): ServerResponse
    {
        return Request::sendMessage([
            'chat_id' => $query->getMessage()->getChat()->getId(),
            'text' => 'Пример клавиатуры',
            'reply_markup'  => NumbersKeyboard::make()->getKeyboard()
        ]);
    }
}