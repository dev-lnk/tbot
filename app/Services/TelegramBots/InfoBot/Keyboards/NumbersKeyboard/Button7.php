<?php

namespace App\Services\TelegramBots\InfoBot\Keyboards\NumbersKeyboard;

use App\Services\TelegramBots\InfoBot\Entities\TelegramButton;
use Longman\TelegramBot\Entities\CallbackQuery;
use Longman\TelegramBot\Entities\ServerResponse;
use Longman\TelegramBot\Exception\TelegramException;
use Longman\TelegramBot\Request;

class Button7 extends TelegramButton
{
    protected string $buttonKey = 'button-7';

    protected string $buttonText = '7';

    /**
     * @throws TelegramException
     */
    public function handle(CallbackQuery $query): ServerResponse
    {
        return Request::sendMessage([
            'parse_mode' => 'HTML',
            'chat_id' => $query->getMessage()->getChat()->getId(),
            'text' => '7'
        ]);
    }
}