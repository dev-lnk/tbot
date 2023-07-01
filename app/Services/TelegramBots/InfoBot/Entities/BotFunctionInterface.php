<?php

namespace App\Services\TelegramBots\InfoBot\Entities;

interface BotFunctionInterface
{
    public static function getHandleFunction(): callable;
}