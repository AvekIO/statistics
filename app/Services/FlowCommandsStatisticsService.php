<?php
declare(strict_types=1);

namespace App\Services;

use App\DTO\FlowCommandsStatisticsDto;
use App\Repositories\FlowCommandsStatisticsRepository;
use Illuminate\Database\Eloquent\Collection;

class FlowCommandsStatisticsService
{
    public function __construct(private readonly FlowCommandsStatisticsRepository $repository)
    {
    }

    public function getSummary(FlowCommandsStatisticsDto $dto): Collection
    {
        return $this->repository->getByFlowIdAndCommandIdAndTriggeredAtInterval(
            $dto->flowId,
            $dto->commandId,
            $dto->triggeredAtFrom,
            $dto->triggeredAtTo
        );
    }
}
