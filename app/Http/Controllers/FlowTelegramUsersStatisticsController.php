<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\DTO\FlowTelegramUsersStatisticsDto;
use App\Http\Requests\FlowTelegramUsersStatisticsIndexRequest;
use App\Services\FlowTelegramUsersStatisticsService;
use Illuminate\Http\JsonResponse;

class FlowTelegramUsersStatisticsController
{
    public function __construct(private readonly FlowTelegramUsersStatisticsService $service)
    {
    }

    public function index(FlowTelegramUsersStatisticsIndexRequest $request): JsonResponse
    {
        $dto = FlowTelegramUsersStatisticsDto::fromRequest($request);
        $collection = $this->service->getCollection($dto);

        return new JsonResponse($collection);
    }
}
