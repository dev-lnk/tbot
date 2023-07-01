<?php

namespace App\Services\TelegramBots\InfoBot\Keyboards\OtherButtons;

use App\Services\TelegramBots\InfoBot\Entities\TelegramButton;
use App\Services\TelegramBots\InfoBot\Keyboards\StylesKeyboard\StylesKeyboard;
use Longman\TelegramBot\Entities\CallbackQuery;
use Longman\TelegramBot\Entities\ServerResponse;
use Longman\TelegramBot\Exception\TelegramException;
use Longman\TelegramBot\Request;

class ButtonStylesKeyboard extends TelegramButton
{
    protected string $buttonKey = 'image-keyboard';

    protected string $buttonText = 'Генерация изображения';

    /**
     * @throws TelegramException
     */
    public function handle(CallbackQuery $query): ServerResponse
    {
        return Request::sendMessage([
            'chat_id' => $query->getMessage()->getChat()->getId(),
            'text' => 'Выберите стиль',
            'reply_markup'  => StylesKeyboard::make()->getKeyboard()
        ]);
    }
}