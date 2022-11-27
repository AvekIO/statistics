<?php
declare(strict_types=1);

namespace App\Services;

use AMQPChannel;
use AMQPChannelException;
use AMQPConnection;
use AMQPConnectionException;
use AMQPEnvelopeException;
use AMQPQueue;
use AMQPQueueException;

class AmqpService
{
    private AMQPConnection $connection;
    private AMQPChannel $channel;
    private AMQPQueue $queue;

    /**
     * @throws AMQPConnectionException
     * @throws AMQPQueueException
     */
    public function __construct()
    {
        $this->connection = $this->createConnection();
        $this->channel = $this->createChannel($this->connection);
        $this->queue = $this->createQueue($this->channel);
    }

    /**
     * @throws AMQPEnvelopeException
     * @throws AMQPQueueException
     * @throws AMQPChannelException
     * @throws AMQPConnectionException
     */
    public function consume(string $queueName, callable $callback): void
    {
        $this->queue->setName($queueName);
        $this->queue->consume($callback);
    }

    /**
     * @throws AMQPConnectionException
     */
    private function createConnection(): AMQPConnection
    {
        $connection = new AMQPConnection($this->getQueueConfig());
        $connection->connect();

        return $connection;
    }

    /**
     * @throws AMQPConnectionException
     */
    private function createChannel(AMQPConnection $connection): AMQPChannel
    {
        return new AMQPChannel($connection);
    }

    /**
     * @throws AMQPConnectionException
     * @throws AMQPQueueException
     */
    private function createQueue(AMQPChannel $channel): AMQPQueue
    {
        return new AMQPQueue($channel);
    }

    private function getQueueConfig(): array
    {
        $connectionName = config('queue.default');

        return config("queue.connections.$connectionName");
    }
}
