<?php

namespace App\Services\TelegramBots\InfoBot\Keyboards\StylesKeyboard;

use App\Services\TelegramBots\InfoBot\Entities\TelegramButton;
use Longman\TelegramBot\Entities\CallbackQuery;
use Longman\TelegramBot\Entities\ServerResponse;
use Longman\TelegramBot\Request;

class ButtonAdultsOnly extends TelegramButton
{
    protected string $buttonKey = '18-image';

    protected string $buttonText = '+18';

    public function handle(CallbackQuery $query): ServerResponse
    {
        $image = storage_path('app/public/images/18.png');

        return Request::sendPhoto([
            'chat_id' => $query->getMessage()->getChat()->getId(),
            'photo'    => $image
        ]);
    }
}