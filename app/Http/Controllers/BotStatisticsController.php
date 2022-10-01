<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\DTO\BotStatisticsDto;
use App\Http\Requests\BotStatisticsIndexRequest;
use App\Services\BotStatisticsService;
use Illuminate\Http\JsonResponse;

class BotStatisticsController
{
    public function __construct(private readonly BotStatisticsService $service)
    {
    }

    public function index(BotStatisticsIndexRequest $request, string $botToken): JsonResponse
    {
        $collection = $this->service->getCollection($this->getDto($botToken, $request));

        return new JsonResponse($collection);
    }

    private function getDto(string $botToken, BotStatisticsIndexRequest $request): BotStatisticsDto
    {
        return new BotStatisticsDto(
            $botToken,
            $request->input('created_at_from'),
            $request->input('created_at_to')
        );
    }
}
