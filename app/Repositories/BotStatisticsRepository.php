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

    public function insert(
        string $botToken,
        int $sent,
        int $received,
        int $triggered,
        int $subscribed,
        int $unsubscribed,
        string $dateHour
    ): bool {
        return $this->model->query()->insert([
            'bot_token' => $botToken,
            'sent' => $sent,
            'received' => $received,
            'triggered' => $triggered,
            'subscribed' => $subscribed,
            'unsubscribed' => $unsubscribed,
            'date_hour' => $dateHour,
        ]);
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
