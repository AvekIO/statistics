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

    public function getList(string $botToken, ?string $createdAtFrom, ?string $createdAtTo): Collection
    {
        return $this->model->query()
            ->where('bot_token', $botToken)
            ->when($createdAtFrom, fn (Builder $query) => $query->where('created_at', '>=', $createdAtFrom))
            ->when($createdAtTo, fn (Builder $query) => $query->where('created_at', '<=', $createdAtTo))
            ->orderBy('created_at')
            ->get();
    }
}
