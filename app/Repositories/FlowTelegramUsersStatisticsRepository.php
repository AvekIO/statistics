<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Models\FlowTelegramUsersStatistics;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class FlowTelegramUsersStatisticsRepository
{
    public function __construct(private readonly FlowTelegramUsersStatistics $model)
    {
    }

    public function getList(int $flowId, ?int $telegramUserId): Collection
    {
        return $this->model->query()
            ->where('flow_id', $flowId)
            ->when($telegramUserId, fn (Builder $query) => $query->where('telegram_user_id', $telegramUserId))
            ->orderBy('subscribed_at', 'desc')
            ->get();
    }
}
