<?php
declare(strict_types=1);

namespace App\Jobs;

use App\DTO\BotStatisticsFieldsDto;
use App\Services\BotStatisticsService;

class SaveBotStatisticsJob implements ConsumableJobInterface
{
    public function __construct(
        private readonly BotStatisticsFieldsDto $dto,
        private readonly BotStatisticsService $service
    ) {}

    public function handle(): void
    {
        $this->service->saveIntoDatabase($this->dto);
    }
}
