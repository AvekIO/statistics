<?php
declare(strict_types=1);

namespace App\Services;

use App\DTO\FlowTelegramUsersStatisticsFieldsDto;
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

    public function saveIntoDatabase(FlowTelegramUsersStatisticsFieldsDto $dto): bool
    {
        return $this->repository->insert(
            $dto->flowId,
            $dto->telegramUserId,
            $dto->sent,
            $dto->received,
            $dto->spaceUsed,
            $dto->subscribedAt,
        );
    }
}
