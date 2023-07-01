<?php

namespace App\Services\TelegramBots\InfoBot\Entities;

use Longman\TelegramBot\Entities\CallbackQuery;
use Longman\TelegramBot\Entities\ServerResponse;
use Longman\TelegramBot\Telegram;

/**
 * Buttons class
 * All buttons are added here
 * @see CallbackqueryCommand::addCallbackHandler()
 */
abstract class TelegramButton implements BotFunctionInterface
{
    protected ?Telegram $telegram;

    protected string $buttonKey = '';

    protected string $buttonText = '';

    public function __construct(
        protected string $value = ''
    ) {}

    abstract public function handle(CallbackQuery $query): ServerResponse;

    public function getValue(CallbackQuery $query): string
    {
        return str_replace($this->buttonKey, '', $query->getData());
    }

    public function data(): array
    {
        return [
            'callback_data' => !empty($this->value)
                ? $this->buttonKey.$this->value
                : $this->buttonKey,

            'text' => $this->buttonText,
        ];
    }

    public function buttonKey(): string
    {
        return $this->buttonKey;
    }

    /**
     * Return the handle() method call function from the TelegramButton class
     *
     * @return callable
     */
    public static function getHandleFunction(): callable
    {
        return function (CallbackQuery $query) {
            $instance = new static();

            if(!str_contains($query->getData(), $instance->buttonKey())) {
                return null;
            }

            return $instance->handle($query);
        };
    }
}