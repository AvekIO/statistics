<?php
declare(strict_types=1);

namespace App\DTO\Amqp;

use AMQPEnvelope;
use Illuminate\Support\Str;

abstract class AbstractMessageDto
{
    private function __construct(protected readonly array $data)
    {
    }

    public function __get(string $name): mixed
    {
        return $this->data[Str::snake($name)];
    }

    public static function fromEnvelope(AMQPEnvelope $message): static
    {
        $data = json_decode($message->getBody(), true);

        return new static($data);
    }
}
