<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\DTO\BotStatisticsFiltersDto;
use App\Http\Requests\BotStatisticsIndexRequest;
use App\Services\BotStatisticsService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BotStatisticsController
{
    public function __construct(private readonly BotStatisticsService $service)
    {
    }

    public function index(BotStatisticsIndexRequest $request, string $botToken): JsonResponse
    {
        $collection = $this->service->getDistributionOverTime($this->wrapIntoDto($botToken, $request));

        return new JsonResponse($collection);
    }

    private function wrapIntoDto(string $botToken, Request $request): BotStatisticsFiltersDto
    {
        return new BotStatisticsFiltersDto(
            $botToken,
            $request->input('date_hour_from'),
            $request->input('date_hour_to')
        );
    }
}
