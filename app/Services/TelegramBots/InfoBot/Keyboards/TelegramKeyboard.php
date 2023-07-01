<?php

namespace App\Services\TelegramBots\InfoBot\Keyboards;

use App\Services\TelegramBots\InfoBot\Entities\TelegramButton;
use App\Support\Traits\Makeable;
use Longman\TelegramBot\Entities\InlineKeyboardButton;
use Longman\TelegramBot\Entities\Keyboard;

abstract class TelegramKeyboard
{
    use Makeable;

    protected array $buttons = [];

    protected Keyboard $keyboard;

    public function __construct(string $value = '')
    {
        $this->keyboard = $this->buildKeyboard($value);
    }

    abstract public function buildKeyboard(string $value = ''): Keyboard;

    protected function inlineButton(TelegramButton $button): InlineKeyboardButton
    {
        return new InlineKeyboardButton($this->setButton($button));
    }

    public function setButton(TelegramButton $button): array
    {
        $this->buttons[] = get_class($button);

        return $button->data();
    }

    public function getKeyboard(): Keyboard
    {
        return $this->keyboard;
    }

    public function getButtons(): array
    {
        return $this->buttons;
    }
}
