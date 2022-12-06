<?php
declare(strict_types=1);

namespace App\Console\Commands\Consumers;

use AMQPEnvelope;
use App\DTO\FlowBlocksStatisticsFieldsDto;
use App\DTO\QueueableDtoInterface;
use App\Jobs\ConsumableJobInterface;
use App\Jobs\SaveFlowBlocksStatisticsJob;
use Illuminate\Contracts\Container\BindingResolutionException;

class FlowBlocksStatisticsConsumer extends AbstractConsumer
{
    protected const COMMAND_NAME = 'consumer:flow_blocks_statistics';
    protected const QUEUE_NAME = 'flow_blocks_statistics';

    /**
     * @throws BindingResolutionException
     */
    public function getJob(AMQPEnvelope $data): ConsumableJobInterface
    {
        return app()->make(SaveFlowBlocksStatisticsJob::class, [
            'dto' => $this->wrapIntoDto($data),
        ]);
    }

    private function wrapIntoDto(AMQPEnvelope $data): QueueableDtoInterface
    {
        return FlowBlocksStatisticsFieldsDto::fromEnvelope($data);
    }
}
