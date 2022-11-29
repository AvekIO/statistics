<?php
declare(strict_types=1);

namespace App\Console\Commands\Consumers;

use AMQPChannelException;
use AMQPConnectionException;
use AMQPEnvelope;
use AMQPEnvelopeException;
use AMQPQueueException;
use App\Jobs\ConsumableJobInterface;
use App\Services\AmqpService;
use Illuminate\Console\Command;

abstract class AbstractConsumer extends Command
{
    public function __construct(protected readonly AmqpService $service)
    {
        $this->setName(static::COMMAND_NAME);

        parent::__construct();
    }

    /**
     * @throws AMQPEnvelopeException
     * @throws AMQPQueueException
     * @throws AMQPChannelException
     * @throws AMQPConnectionException
     */
    public function handle(): void
    {
        $this->service->consume(
            static::QUEUE_NAME,
            fn (AMQPEnvelope $data) => $this->getJob($data)->handle()
        );
    }

    abstract public function getJob(AMQPEnvelope $data): ConsumableJobInterface;
}
