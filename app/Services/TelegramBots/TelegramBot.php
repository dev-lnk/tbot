<?php

namespace App\Services\TelegramBots;

use App\Services\TelegramBots\InfoBot\Commands\System\CallbackqueryCommand;
use App\Services\TelegramBots\InfoBot\Entities\BotFunctionInterface;
use Longman\TelegramBot\Entities\ServerResponse;
use Longman\TelegramBot\Entities\Update;
use Longman\TelegramBot\Exception\TelegramException;
use Longman\TelegramBot\Request;
use Longman\TelegramBot\Telegram;
use Throwable;

abstract class TelegramBot
{
    protected Telegram $telegram;

    /**
     * @throws TelegramException
     */
    public function __construct(
        protected string $botApiKey,
        protected string $botUsername,
        protected string $commandsPath = '',
    ) {
        $this->telegram = new Telegram($this->botApiKey, $this->botUsername);

        if(!empty($this->commandsPath)){
            $this->telegram->setCommandsPath($this->commandsPath);
        }

        $this->setBot();
    }

    abstract public function setBot(): void;

    /**
     * Sync handling of bot events
     *
     * @return void
     *
     * @throws Throwable
     */
    public function update(): void
    {
        $response = $this->getUpdates();
        if ($response->isOk()) {
            foreach ($response->getResult() as $result) {
                $this->processUpdate($result);
            }
        }
    }

    /**
     * Async handling of bot events
     * $function - must be an async function
     *
     * @param int      $updateId
     * @param callable $function
     *
     * @return int
     */
    public function updateAsync(int $updateId, Callable $function): int
    {
        $response = $this->getUpdates();
        if (!$response->isOk()) {
            return 0;
        }

        $ids = [$updateId];
        foreach ($response->getResult() as $result) {
            if(
                !empty($updateId)
                && $result->update_id <= $updateId
            ) {
                continue;
            }

            $function($result);

            $ids[] = $result->update_id;

            dump("Update id is dispatched: ". $result->update_id);
        }

        return max($ids);
    }

    /**
     * Get all bot events
     *
     * @return ServerResponse
     */
    protected function getUpdates(): ServerResponse
    {
        return Request::getUpdates([
            'limit' => null
        ]);
    }

    /**
     * Bot event handling
     *
     * @param Update $update
     *
     * @return void
     *
     * @throws Throwable
     */
    public function processUpdate(Update $update): void
    {
        try {

            dump('processUpdate: '. $update->getUpdateId());

            $this->telegram->processUpdate($update);

            Request::getUpdates(['offset'   => $update->getUpdateId() + 1, 'limit' => 1]);

        } catch (Throwable $e) {
            report_app($e);
        }
    }

    /**
     * Adding button handlers
     *
     * @param BotFunctionInterface $function
     *
     * @return void
     */
    public function addFunctionInCallback(BotFunctionInterface $function): void
    {
        CallbackqueryCommand::addCallbackHandler($function::getHandleFunction());
    }

    /**
     * Webhook Processing
     *
     * @throws TelegramException
     */
    public function handle(): bool
    {
        return $this->telegram->handle();
    }

    /**
     * @throws TelegramException
     */
    public function setWebHook(string $webhookUrl): ServerResponse
    {
        return $this->telegram->setWebhook($webhookUrl);
    }
}