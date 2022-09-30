<?php
declare(strict_types=1);

use App\Http\Controllers\BotStatisticsController;
use App\Http\Controllers\FlowBlockStatisticsController;
use App\Http\Controllers\FlowCommandsStatisticsController;
use App\Http\Controllers\FlowTelegramUsersStatisticsController;
use Illuminate\Support\Facades\Route;

Route::get('/statistics/bot', [BotStatisticsController::class, 'index']);
Route::get('/statistics/flow-commands', [FlowCommandsStatisticsController::class, 'index']);
Route::get('/statistics/flow-block', [FlowBlockStatisticsController::class, 'index']);
Route::get('/statistics/flow-telegram-users', [FlowTelegramUsersStatisticsController::class, 'index']);
