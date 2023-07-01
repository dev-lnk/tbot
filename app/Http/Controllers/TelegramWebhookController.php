<?php

namespace App\Http\Controllers;

use App\Services\TelegramBots\InfoBot\InfoBot;
use Longman\TelegramBot\Exception\TelegramException;
use Throwable;

class TelegramWebhookController extends Controller
{
    /**
     * @throws Throwable
     */
    public function webhook()
    {
        try {
            $bot = InfoBot::makeBot();
            $bot->handle();
        } catch (TelegramException $e) {
            report_app($e);
        }
    }
}
