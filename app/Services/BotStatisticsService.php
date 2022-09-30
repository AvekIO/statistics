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

    public function getCollection(BotStatisticsDto $dto): Collection
    {
        return $this->repository->getList($dto->botToken, $dto->createdAtFrom, $dto->createdAtTo);
    }
}
