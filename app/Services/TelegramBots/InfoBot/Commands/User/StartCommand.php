<?php

namespace App\Services\TelegramBots\InfoBot\Commands\User;

use App\Services\TelegramBots\InfoBot\Keyboards\ImageKeyboard\ImageKeyboard;
use App\Services\TelegramBots\InfoBot\Keyboards\StartKeyboard\StartKeyboard;
use App\Types\Style;
use Longman\TelegramBot\Commands\UserCommand;
use Longman\TelegramBot\Entities\Keyboard;
use Longman\TelegramBot\Entities\ServerResponse;
use Longman\TelegramBot\Exception\TelegramException;
use Longman\TelegramBot\Request;
use Throwable;
use ValueError;

/**
 * Start command
 */
class StartCommand extends UserCommand
{
    /**
     * @var string
     */
    protected $name = 'start';

    /**
     * @var string
     */
    protected $description = 'Start command';

    /**
     * @var string
     */
    protected $usage = '/start';

    /**
     * @var string
     */
    protected $version = '1.2.0';

    /**
     * @return ServerResponse
     * @throws TelegramException
     * @throws Throwable
     */
    public function execute(): ServerResponse
    {
        $message = $this->getMessage();

        $chatId = $message->getChat()->getId();

        //https://t.me/tbot_info_bot?start=real
        $style = $message->getText(true);

        if(empty($style)) {
            return $this->send('Главное меню', $chatId, StartKeyboard::make()->getKeyboard());
        }

        try {
            $styleName = Style::from($style)->name();
        } catch (ValueError $e) {
            report_app($e);
            return $this->send('Главное меню', $chatId, StartKeyboard::make()->getKeyboard());
        } catch (Throwable $e) {
            report_app($e);
        }

        $keyboard = ImageKeyboard::make($style)->getKeyboard();

        return $this->send("Выбранный стиль: $styleName, что рисовать?", $chatId, $keyboard);
    }

    /**
     * @throws TelegramException
     */
    private function send(string $text, int $chatId, Keyboard $keyboard): ServerResponse
    {
        return Request::sendMessage([
            'chat_id'       => $chatId,
            'text'          => $text,
            'reply_markup'  => $keyboard
        ]);
    }
}
