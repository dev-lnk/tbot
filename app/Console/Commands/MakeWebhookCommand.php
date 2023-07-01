<?php

namespace App\Console\Commands;

use App\Services\TelegramBots\InfoBot\InfoBot;
use Illuminate\Console\Command;
use Longman\TelegramBot\Exception\TelegramException;

class MakeWebhookCommand extends Command
{
    protected $signature = 'infobot:webhook {url}';

    protected $description = 'webhook';

    /**
     * @throws TelegramException
     */
    public function handle(): int
    {
        $url = $this->argument('url');

        $bot = InfoBot::makeBot();
        $response = $bot->setWebHook($url);

        if(!$response->isOk()) {
            dump($response);
            $this->error('Failure');
            return Command::FAILURE;
        }

        $this->info('Webhook added');
        return Command::SUCCESS;
    }
}
