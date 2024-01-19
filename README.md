
Creating a telegram bot keyboard using the example of the [telegram](https://github.com/php-telegram-bot/core) library.

The core logic is in [app/Services/TelegramBots/InfoBot/Keyboards](https://github.com/levchenko-ivan/tbot/tree/master/app/Services/TelegramBots/InfoBot/Keyboards)

Button clicks are handled in [CallbackqueryCommand](https://github.com/levchenko-ivan/tbot/blob/master/app/Services/TelegramBots/InfoBot/Commands/System/CallbackqueryCommand.php). Handlers are added during the construction of the bot in [InfoBot](https://github.com/levchenko-ivan/tbot/blob/master/app/Services/TelegramBots/InfoBot/InfoBot.php)

If you want to run your bot, then you need to install:
1) Copy .env.example and rename to .env
2) Add your bot settings to variables TELEGRAM_API_KEY and TELEGRAM_USERNAME
3) If you are using docker compose execute <code>docker-compose up --build -d</code>
4) Execute <code>composer install</code>
5) To start the bot, run <code>php artisan infobot:start</code>

Test 2