<?php
declare(strict_types=1);

namespace App\Services;

use App\DTO\FlowTelegramUsersStatisticsDto;
use App\Repositories\FlowTelegramUsersStatisticsRepository;
use Illuminate\Database\Eloquent\Collection;

class FlowTelegramUsersStatisticsService
{
    public function __construct(private readonly FlowTelegramUsersStatisticsRepository $repository)
    {
    }

    public function getCollection(FlowTelegramUsersStatisticsDto $dto): Collection
    {
        return $this->repository->getList($dto->flowId, $dto->telegramUserId);
    }
}
