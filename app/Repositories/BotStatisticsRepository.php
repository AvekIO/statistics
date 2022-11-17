<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Models\BotStatistics;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class BotStatisticsRepository
{
    public function __construct(private readonly BotStatistics $model)
    {
    }

    public function getByBotTokenAndDateHourInterval(string $botToken, ?string $dateHourFrom, ?string $dateHourTo): Collection
    {
        return $this->model->query()
            ->where('bot_token', $botToken)
            ->when($dateHourFrom, fn (Builder $query) => $query->where('date_hour', '>=', $dateHourFrom))
            ->when($dateHourTo, fn (Builder $query) => $query->where('date_hour', '<=', $dateHourTo))
            ->orderBy('date_hour')
            ->get();
    }
}
