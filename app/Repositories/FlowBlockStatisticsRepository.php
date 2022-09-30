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

    public function getList(int $flowId, ?int $blockId, ?string $createdAtFrom, ?string $createdAtTo): Collection
    {
        return $this->model->query()
            ->where('flow_id', $flowId)
            ->when($blockId, fn (Builder $query) => $query->where('block_id', $blockId))
            ->when($createdAtFrom, fn (Builder $query) => $query->where('created_at', '>=', $createdAtFrom))
            ->when($createdAtTo, fn (Builder $query) => $query->where('created_at', '<=', $createdAtTo))
            ->orderBy('created_at')
            ->get();
    }
}
