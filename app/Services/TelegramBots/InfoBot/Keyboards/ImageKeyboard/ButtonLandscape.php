<?php

namespace App\Services\TelegramBots\InfoBot\Keyboards\ImageKeyboard;

use App\Services\TelegramBots\InfoBot\Entities\TelegramButton;
use App\Services\TelegramBots\InfoBot\Traits\ImageSelector;
use App\Types\Style;
use Longman\TelegramBot\Entities\CallbackQuery;
use Longman\TelegramBot\Entities\ServerResponse;
use Longman\TelegramBot\Exception\TelegramException;
use Longman\TelegramBot\Request;

class ButtonLandscape extends TelegramButton
{
    use ImageSelector;

    protected string $buttonKey = 'landscape-image';

    protected string $buttonText = 'Пейзаж';

    /**
     * @throws TelegramException
     */
    public function handle(CallbackQuery $query): ServerResponse
    {
        $style = Style::from($this->getValue($query));

        $image = $this->selectImage('landscape', $style);

        Request::sendPhoto([
            'chat_id' => $query->getMessage()->getChat()->getId(),
            'photo'    => $image
        ]);

        return Request::sendMessage([
            'chat_id' => $query->getMessage()->getChat()->getId(),
            'text' => "Выбранный стиль: {$style->name()}, что рисовать?",
            'reply_markup'  => ImageKeyboard::make($style->value)->getKeyboard()
        ]);
    }
}