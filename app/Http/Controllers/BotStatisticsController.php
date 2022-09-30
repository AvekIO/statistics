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

    public function index(BotStatisticsIndexRequest $request): JsonResponse
    {
        $dto = BotStatisticsDto::fromRequest($request);
        $collection = $this->service->getCollection($dto);

        return new JsonResponse($collection);
    }
}
