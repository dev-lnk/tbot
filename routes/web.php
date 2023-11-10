<?php

use App\Http\Controllers\TelegramWebhookController;
use Illuminate\Support\Facades\Route;

$settings = [
    //'middleware' => ['telegram_webhook'],
    'excluded_middleware' => ['web'],
];
Route::group($settings, function () {
    Route::post('/webhook/telegram', [TelegramWebhookController::class, 'webhook'])->name('webhook.telegram');
});

Route::get('/test', function () {
    return 'It is a test: '.config('app.url');
});
