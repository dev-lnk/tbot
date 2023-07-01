<?php

namespace App\Console\Commands;

use App\Jobs\InfoBotProcessUpdate;
use App\Services\TelegramBots\InfoBot\InfoBot;
use Illuminate\Console\Command;
use Longman\TelegramBot\Entities\Update;
use Modules\Orders\Features\Bots\TelegramOrderBot\Commands\Keyboards\AppKeyboardCallbacks;
use Modules\Orders\Features\Bots\TelegramOrderBot\Commands\Keyboards\InitCall\NoCallButton;
use Modules\Orders\Features\Bots\TelegramOrderBot\Commands\Keyboards\InitCall\YesCallButton;
use Modules\Orders\Features\Bots\TelegramOrderBot\Commands\Keyboards\MyOrders\ChangeOrderButton;
use Modules\Orders\Features\Bots\TelegramOrderBot\Commands\Keyboards\OrderInfo\OrderChangeButton;
use Modules\Orders\Features\Bots\TelegramOrderBot\Commands\Keyboards\OrderInfo\OrderInfoButton;
use Modules\Orders\Features\Bots\TelegramOrderBot\Commands\Keyboards\OrderInfo\OrderManagerButton;
use Modules\Orders\Features\Bots\TelegramOrderBot\Commands\Keyboards\OrderInfo\OrderPayButton;
use Modules\Orders\Features\Bots\TelegramOrderBot\Commands\Keyboards\OrderInfo\OrderQuestionButton;
use Modules\Orders\Features\Bots\TelegramOrderBot\Commands\System\CallbackqueryCommand;
use Modules\Orders\Features\Bots\TelegramOrderBot\TelegramOrderBot;

class InfoBotCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'infobot:start';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Запуск бота в локальном окружении';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        set_time_limit(0);
        ini_set('memory_limit', '500M');
        ini_set('max_execution_time', 0);

        try {
            $bot = InfoBot::makeBot();

            //$updateId = 0;

            while (true) {

//                $updateId = $bot->updateAsync($updateId, function (Update $update) {
//                    InfoBotProcessUpdate::dispatch($update);
//                });

                $bot->update();

                sleep(1);
            }

        } catch (\Throwable $e) {
            dump('Error:'.$e->getMessage(). ' File:'. $e->getFile(). ' Line:'.$e->getLine(). ' '.get_class($e));
        }
    }
}
