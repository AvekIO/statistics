<?php
declare(strict_types=1);

namespace App\Jobs;

use App\DTO\FlowCommandsStatisticsFieldsDto;
use App\Services\FlowCommandsStatisticsService;

class SaveFlowCommandsStatisticsJob implements ConsumableJobInterface
{
    public function __construct(
        private readonly FlowCommandsStatisticsFieldsDto $dto,
        private readonly FlowCommandsStatisticsService $service
    ) {}

    public function handle(): void
    {
        $this->service->saveIntoDatabase($this->dto);
    }
}
