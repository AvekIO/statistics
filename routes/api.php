<?php
declare(strict_types=1);

use App\Http\Controllers\BotStatisticsController;
use App\Http\Controllers\FlowBlockStatisticsController;
use App\Http\Controllers\FlowCommandsStatisticsController;
use App\Http\Controllers\FlowTelegramUsersStatisticsController;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

Route::get('/bot/{bot_token}', [BotStatisticsController::class, 'index']);
Route::get('/flow/{flow_id}/commands/{command_id?}', [FlowCommandsStatisticsController::class, 'index']);
Route::get('/flow/{flow_id}/blocks/{block_id?}', [FlowBlockStatisticsController::class, 'index']);
Route::get('/flow/{flow_id}/telegram-users', [FlowTelegramUsersStatisticsController::class, 'index']);

Route::fallback(fn () => new Response('Not found', Response::HTTP_NOT_FOUND));
