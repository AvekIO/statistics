<?php
declare(strict_types=1);

use App\Http\Controllers\BotStatisticsController;
use App\Http\Controllers\FlowBlockStatisticsController;
use App\Http\Controllers\FlowCommandsStatisticsController;
use App\Http\Controllers\FlowTelegramUsersStatisticsController;
use App\Http\Responses\NotFoundResponse;
use Illuminate\Routing\Router;

/** @var Router $router */
$router->get('/bots/{bot_token}', [BotStatisticsController::class, 'index']);
$router->get('/flows/{flow_id}/commands/{command_id?}', [FlowCommandsStatisticsController::class, 'index']);
$router->get('/flows/{flow_id}/blocks/{block_id?}', [FlowBlockStatisticsController::class, 'index']);
$router->get('/flows/{flow_id}/telegram-users/{telegram_user_id?}', [FlowTelegramUsersStatisticsController::class, 'index']);

$router->fallback(fn () => new NotFoundResponse());
