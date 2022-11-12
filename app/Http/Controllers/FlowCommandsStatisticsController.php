<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\DTO\FlowCommandsStatisticsDto;
use App\Http\Requests\BaseRequest;
use App\Services\FlowCommandsStatisticsService;
use Illuminate\Http\JsonResponse;

class FlowCommandsStatisticsController
{
    public function __construct(private readonly FlowCommandsStatisticsService $service)
    {
    }

    public function index(BaseRequest $request, int $flowId, int $commandId = null): JsonResponse
    {
        $collection = $this->service->getCollection($this->convertToDto($flowId, $commandId, $request));

        return new JsonResponse($collection);
    }

    private function convertToDto(int $flowId, ?int $commandId, BaseRequest $request): FlowCommandsStatisticsDto
    {
        return new FlowCommandsStatisticsDto(
            $flowId,
            $commandId,
            $request->input('created_at_from'),
            $request->input('created_at_to')
        );
    }
}
