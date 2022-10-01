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

    public function getList(int $flowId, ?int $commandId, ?string $createdAtFrom, ?string $createdAtTo): Collection
    {
        return $this->model->query()
            ->where('flow_id', $flowId)
            ->when($commandId, fn (Builder $query) => $query->where('command_id', $commandId))
            ->when($createdAtFrom, fn (Builder $query) => $query->where('created_at', '>=', $createdAtFrom))
            ->when($createdAtTo, fn (Builder $query) => $query->where('created_at', '<=', $createdAtTo))
            ->orderBy('created_at')
            ->get();
    }
}
