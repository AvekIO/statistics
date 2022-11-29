<?php
declare(strict_types=1);

namespace App\Console\Commands\Consumers;

use AMQPEnvelope;
use App\DTO\FlowTelegramUsersStatisticsFieldsDto;
use App\DTO\QueueableDtoInterface;
use App\Jobs\ConsumableJobInterface;
use App\Jobs\SaveFlowTelegramUsersStatisticsJob;
use Illuminate\Contracts\Container\BindingResolutionException;

class FlowTelegramUsersStatisticsConsumer extends AbstractConsumer
{
    protected const COMMAND_NAME = 'consumer:flow_telegram_users_statistics';
    protected const QUEUE_NAME = 'flow_telegram_users_statistics';

    /**
     * @throws BindingResolutionException
     */
    public function getJob(AMQPEnvelope $data): ConsumableJobInterface
    {
        return app()->make(SaveFlowTelegramUsersStatisticsJob::class, [
            'dto' => $this->wrapIntoDto($data),
        ]);
    }

    private function wrapIntoDto(AMQPEnvelope $data): QueueableDtoInterface
    {
        return FlowTelegramUsersStatisticsFieldsDto::fromEnvelope($data);
    }
}
