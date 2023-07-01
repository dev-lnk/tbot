<?php

namespace App\Services\TelegramBots\InfoBot\Keyboards\StartKeyboard;


use App\Services\TelegramBots\InfoBot\Entities\TelegramButton;
use App\Support\Traits\Makeable;
use Longman\TelegramBot\Entities\CallbackQuery;
use Longman\TelegramBot\Entities\ServerResponse;
use Longman\TelegramBot\Exception\TelegramException;
use Longman\TelegramBot\Request;

class ButtonAccount extends TelegramButton
{
    protected string $buttonKey = 'account';

    protected string $buttonText = 'Получить информацию по аккаунту';

    /**
     * @throws TelegramException
     */
    public function handle(CallbackQuery $query): ServerResponse
    {
        $accountInfo = $query->getMessage()->getChat();

        $text = "Ваше имя: <b>{$accountInfo->getFirstName()}</b>\n";
        $text .= "Ваша фамилия: <b>{$accountInfo->getLastName()}</b>\n";
        $text .= "Ваш ник: <b>{$accountInfo->getUsername()}</b>\n";

        return Request::sendMessage([
            'parse_mode' => 'HTML',
            'chat_id' => $query->getMessage()->getChat()->getId(),
            'text' => $text
        ]);
    }
}