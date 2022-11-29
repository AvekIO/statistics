<?php
declare(strict_types=1);

namespace App\Services;

use App\DTO\BotStatisticsFiltersDto;
use App\Repositories\BotStatisticsRepository;
use Illuminate\Database\Eloquent\Collection;

class BotStatisticsService
{
    public function __construct(private readonly BotStatisticsRepository $repository)
    {
    }

    public function getDistributionOverTime(BotStatisticsFiltersDto $dto): Collection
    {
        return $this->repository->getByBotTokenAndDateHourInterval($dto->botToken, $dto->dateHourFrom, $dto->dateHourTo);
    }
}
