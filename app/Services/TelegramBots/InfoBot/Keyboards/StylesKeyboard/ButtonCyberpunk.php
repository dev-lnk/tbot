<?php

namespace App\Services\TelegramBots\InfoBot\Keyboards\StylesKeyboard;

use App\Services\TelegramBots\InfoBot\Entities\TelegramButton;
use App\Services\TelegramBots\InfoBot\Keyboards\ImageKeyboard\ImageKeyboard;
use App\Types\Style;
use Longman\TelegramBot\Entities\CallbackQuery;
use Longman\TelegramBot\Entities\ServerResponse;
use Longman\TelegramBot\Exception\TelegramException;
use Longman\TelegramBot\Request;

class ButtonCyberpunk extends TelegramButton
{
    protected string $buttonKey = 'cyberpunk-style';

    protected string $buttonText = 'Киберпанк';

    /**
     * @throws TelegramException
     */
    public function handle(CallbackQuery $query): ServerResponse
    {
        return Request::sendMessage([
            'chat_id' => $query->getMessage()->getChat()->getId(),
            'text' => "Выбранный стиль: {$this->buttonText}, что рисовать?",
            'reply_markup'  => ImageKeyboard::make(Style::Cyberpunk->value)->getKeyboard()
        ]);
    }
}