<?php
declare(strict_types=1);

namespace App\Jobs;

use App\DTO\FlowBlocksStatisticsFieldsDto;
use App\Services\FlowBlocksStatisticsService;

class SaveFlowBlockStatisticsJob
{
    public function __construct(
        private readonly FlowBlocksStatisticsFieldsDto $dto,
        private readonly FlowBlocksStatisticsService $service
    ) {}

    public function handle(): void
    {
        $this->service->saveIntoDatabase($this->dto);
    }
}
