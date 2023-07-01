<?php

namespace App\Jobs;

use App\Services\TelegramBots\InfoBot\InfoBot;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Longman\TelegramBot\Entities\Update;

class InfoBotProcessUpdate implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        private readonly Update $update
    ) {}

    public function handle(): void
    {
        $bot = InfoBot::makeBot();
        $bot->processUpdate($this->update);
    }
}
