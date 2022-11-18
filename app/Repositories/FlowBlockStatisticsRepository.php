<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Models\FlowBlockStatistics;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class FlowBlockStatisticsRepository
{
    public function __construct(private readonly FlowBlockStatistics $model)
    {
    }

    public function getByFlowIdAndBlockIdAndTriggeredAtInterval(
        int $flowId,
        ?int $blockId,
        ?string $triggeredAtFrom,
        ?string $triggeredAtTo
    ): Collection {
        return $this->model->query()
            ->where('flow_id', $flowId)
            ->when($blockId, fn (Builder $query) => $query->where('block_id', $blockId))
            ->when($triggeredAtFrom, fn (Builder $query) => $query->where('triggered_at', '>=', $triggeredAtFrom))
            ->when($triggeredAtTo, fn (Builder $query) => $query->where('triggered_at', '<=', $triggeredAtTo))
            ->orderBy('triggered_at')
            ->get();
    }
}
