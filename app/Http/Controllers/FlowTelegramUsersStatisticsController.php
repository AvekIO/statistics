<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\DTO\FlowTelegramUsersStatisticsFiltersDto;
use App\Http\Requests\FlowTelegramUsersStatisticsIndexRequest;
use App\Services\FlowTelegramUsersStatisticsService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FlowTelegramUsersStatisticsController
{
    public function __construct(private readonly FlowTelegramUsersStatisticsService $service)
    {
    }

    public function index(FlowTelegramUsersStatisticsIndexRequest $request, int $flowId, int $telegramUserId = null): JsonResponse
    {
        $collection = $this->service->getSummary($this->wrapIntoDto($flowId, $telegramUserId, $request));

        return new JsonResponse($collection);
    }

    private function wrapIntoDto(int $flowId, ?int $telegramUserId, Request $request): FlowTelegramUsersStatisticsFiltersDto
    {
        return new FlowTelegramUsersStatisticsFiltersDto(
            $flowId,
            $telegramUserId,
            $request->input('subscribed_at_from'),
            $request->input('subscribed_at_to')
        );
    }
}
