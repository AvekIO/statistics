<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Models\FlowCommandsStatistics;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class FlowCommandsStatisticsRepository
{
    public function __construct(private readonly FlowCommandsStatistics $model)
    {
    }

    public function insert(int $flowId, int $commandId, int $botChatTelegramUserId, string $triggeredAt): bool
    {
        return $this->model->query()->insert([
            'flow_id' => $flowId,
            'command_id' => $commandId,
            'bot_chat_telegram_user_id' => $botChatTelegramUserId,
            'triggered_at' => $triggeredAt,
        ]);
    }

    public function getByFlowIdAndCommandIdAndTriggeredAtInterval(
        int $flowId,
        ?int $commandId,
        ?string $triggeredAtFrom,
        ?string $triggeredAtTo
    ): Collection {
        return $this->model->query()
            ->where('flow_id', $flowId)
            ->when($commandId, fn (Builder $query) => $query->where('command_id', $commandId))
            ->when($triggeredAtFrom, fn (Builder $query) => $query->where('triggered_at', '>=', $triggeredAtFrom))
            ->when($triggeredAtTo, fn (Builder $query) => $query->where('triggered_at', '<=', $triggeredAtTo))
            ->orderBy('triggered_at')
            ->get();
    }
}
