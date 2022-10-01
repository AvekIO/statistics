<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\DTO\FlowBlockStatisticsDto;
use App\Http\Requests\FlowBlockStatisticsIndexRequest;
use App\Services\FlowBlockStatisticsService;
use Illuminate\Http\JsonResponse;

class FlowBlockStatisticsController
{
    public function __construct(private readonly FlowBlockStatisticsService $service)
    {
    }

    public function index(FlowBlockStatisticsIndexRequest $request, int $flowId, int $blockId = null): JsonResponse
    {
        $collection = $this->service->getCollection($this->getDto($flowId, $blockId, $request));

        return new JsonResponse($collection);
    }

    private function getDto(int $flowId, ?int $blockId, FlowBlockStatisticsIndexRequest $request): FlowBlockStatisticsDto
    {
        return new FlowBlockStatisticsDto(
            $flowId,
            $blockId,
            $request->input('created_at_from'),
            $request->input('created_at_to')
        );
    }
}
