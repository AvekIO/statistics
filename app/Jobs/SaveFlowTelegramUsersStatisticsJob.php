<?php
declare(strict_types=1);

namespace App\Jobs;

use App\DTO\FlowTelegramUsersStatisticsFieldsDto;
use App\Services\FlowTelegramUsersStatisticsService;

class SaveFlowTelegramUsersStatisticsJob implements ConsumableJobInterface
{
    public function __construct(
        private readonly FlowTelegramUsersStatisticsFieldsDto $dto,
        private readonly FlowTelegramUsersStatisticsService $service
    ) {}

    public function handle(): void
    {
        $this->service->saveIntoDatabase($this->dto);
    }
}
