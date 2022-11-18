<?php
declare(strict_types=1);

namespace App\Services;

use App\DTO\BotStatisticsDto;
use App\Repositories\BotStatisticsRepository;
use Illuminate\Database\Eloquent\Collection;

class BotStatisticsService
{
    public function __construct(private readonly BotStatisticsRepository $repository)
    {
    }

    public function getDistributionOverTime(BotStatisticsDto $dto): Collection
    {
        return $this->repository->getByBotTokenAndDateHourInterval($dto->botToken, $dto->dateHourFrom, $dto->dateHourTo);
    }
}
