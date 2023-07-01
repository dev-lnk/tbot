<?php

namespace App\Services\TelegramBots\InfoBot\Keyboards\NumbersKeyboard;

use App\Services\TelegramBots\InfoBot\Entities\TelegramButton;
use Longman\TelegramBot\Entities\CallbackQuery;
use Longman\TelegramBot\Entities\ServerResponse;
use Longman\TelegramBot\Exception\TelegramException;
use Longman\TelegramBot\Request;

class Button6 extends TelegramButton
{
    protected string $buttonKey = 'button-6';

    protected string $buttonText = '6';

    /**
     * @throws TelegramException
     */
    public function handle(CallbackQuery $query): ServerResponse
    {
        return Request::sendMessage([
            'parse_mode' => 'HTML',
            'chat_id' => $query->getMessage()->getChat()->getId(),
            'text' => '6'
        ]);
    }
}