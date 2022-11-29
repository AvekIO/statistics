<?php
declare(strict_types=1);

namespace App\Services;

use App\DTO\FlowTelegramUsersStatisticsFiltersDto;
use App\Repositories\FlowTelegramUsersStatisticsRepository;
use Illuminate\Database\Eloquent\Collection;

class FlowTelegramUsersStatisticsService
{
    public function __construct(private readonly FlowTelegramUsersStatisticsRepository $repository)
    {
    }

    public function getSummary(FlowTelegramUsersStatisticsFiltersDto $dto): Collection
    {
        return $this->repository->getByFlowIdAndTelegramUserIdAndSubscribedAtInterval(
            $dto->flowId,
            $dto->telegramUserId,
            $dto->subscribedAtFrom,
            $dto->subscribedAtTo
        );
    }
}
