<?php
declare(strict_types=1);

namespace App\Services;

use App\DTO\FlowBlockStatisticsDto;
use App\Repositories\FlowBlockStatisticsRepository;
use Illuminate\Database\Eloquent\Collection;

class FlowBlockStatisticsService
{
    public function __construct(private readonly FlowBlockStatisticsRepository $repository)
    {
    }

    public function getCollection(FlowBlockStatisticsDto $dto): Collection
    {
        return $this->repository->getList($dto->flowId, $dto->blockId, $dto->createdAtFrom, $dto->createdAtTo);
    }
}
