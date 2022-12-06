<?php
declare(strict_types=1);

namespace App\Console\Commands\Consumers;

use AMQPEnvelope;
use App\DTO\BotStatisticsFieldsDto;
use App\DTO\QueueableDtoInterface;
use App\Jobs\ConsumableJobInterface;
use App\Jobs\SaveBotStatisticsJob;
use Illuminate\Contracts\Container\BindingResolutionException;

class BotStatisticsConsumer extends AbstractConsumer
{
    protected const COMMAND_NAME = 'consumer:bot_statistics';
    protected const QUEUE_NAME = 'bot_statistics';

    /**
     * @throws BindingResolutionException
     */
    public function getJob(AMQPEnvelope $data): ConsumableJobInterface
    {
        return app()->make(SaveBotStatisticsJob::class, [
            'dto' => $this->wrapIntoDto($data),
        ]);
    }

    private function wrapIntoDto(AMQPEnvelope $data): QueueableDtoInterface
    {
        return BotStatisticsFieldsDto::fromEnvelope($data);
    }
}
