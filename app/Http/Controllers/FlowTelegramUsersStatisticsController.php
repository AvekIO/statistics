<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\DTO\FlowTelegramUsersStatisticsDto;
use App\Services\FlowTelegramUsersStatisticsService;
use Illuminate\Http\JsonResponse;

class FlowTelegramUsersStatisticsController
{
    public function __construct(private readonly FlowTelegramUsersStatisticsService $service)
    {
    }

    public function index(int $flowId, int $telegramUserId = null): JsonResponse
    {
        $collection = $this->service->getCollection($this->convertToDto($flowId, $telegramUserId));

        return new JsonResponse($collection);
    }

    private function convertToDto(int $flowId, ?int $telegramUserId): FlowTelegramUsersStatisticsDto
    {
        return new FlowTelegramUsersStatisticsDto($flowId, $telegramUserId);
    }
}
