<?php
declare(strict_types=1);

namespace App\Services;

use App\DTO\BotStatisticsFieldsDto;
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

    public function saveIntoDatabase(BotStatisticsFieldsDto $dto): bool
    {
        return $this->repository->insert(
            $dto->botToken,
            $dto->sent,
            $dto->received,
            $dto->triggered,
            $dto->subscribed,
            $dto->unsubscribed,
            $dto->dateHour
        );
    }
}
