<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\DTO\BotStatisticsDto;
use App\Http\Requests\BaseRequest;
use App\Services\BotStatisticsService;
use Illuminate\Http\JsonResponse;

class BotStatisticsController
{
    public function __construct(private readonly BotStatisticsService $service)
    {
    }

    public function index(BaseRequest $request, string $botToken): JsonResponse
    {
        $collection = $this->service->getDistributionOverTime($this->convertToDto($botToken, $request));

        return new JsonResponse($collection);
    }

    private function convertToDto(string $botToken, BaseRequest $request): BotStatisticsDto
    {
        return new BotStatisticsDto(
            $botToken,
            $request->input('date_hour_from'),
            $request->input('date_hour_to')
        );
    }
}
