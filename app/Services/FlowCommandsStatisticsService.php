<?php
declare(strict_types=1);

namespace App\Services;

use App\DTO\FlowCommandsStatisticsFieldsDto;
use App\DTO\FlowCommandsStatisticsFiltersDto;
use App\Repositories\FlowCommandsStatisticsRepository;
use Illuminate\Database\Eloquent\Collection;

class FlowCommandsStatisticsService
{
    public function __construct(private readonly FlowCommandsStatisticsRepository $repository)
    {
    }

    public function getSummary(FlowCommandsStatisticsFiltersDto $dto): Collection
    {
        return $this->repository->getByFlowIdAndCommandIdAndTriggeredAtInterval(
            $dto->flowId,
            $dto->commandId,
            $dto->triggeredAtFrom,
            $dto->triggeredAtTo
        );
    }

    public function saveIntoDatabase(FlowCommandsStatisticsFieldsDto $dto): bool
    {
        return $this->repository->insert(
            $dto->flowId,
            $dto->commandId,
            $dto->botChatTelegramUserId,
            $dto->triggeredAt,
        );
    }
}
