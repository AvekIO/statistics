<?php
declare(strict_types=1);

namespace App\Services;

use App\DTO\FlowBlocksStatisticsFieldsDto;
use App\DTO\FlowBlocksStatisticsFiltersDto;
use App\Repositories\FlowBlockStatisticsRepository;
use Illuminate\Database\Eloquent\Collection;

class FlowBlocksStatisticsService
{
    public function __construct(private readonly FlowBlockStatisticsRepository $repository)
    {
    }

    public function getSummary(FlowBlocksStatisticsFiltersDto $dto): Collection
    {
        return $this->repository->getByFlowIdAndBlockIdAndTriggeredAtInterval(
            $dto->flowId,
            $dto->blockId,
            $dto->triggeredAtFrom,
            $dto->triggeredAtTo
        );
    }

    public function saveIntoDatabase(FlowBlocksStatisticsFieldsDto $dto): bool
    {
        return $this->repository->insert(
            $dto->flowId,
            $dto->blockId,
            $dto->messageId,
            $dto->triggeredAt,
        );
    }
}
