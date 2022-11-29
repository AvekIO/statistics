<?php
declare(strict_types=1);

namespace App\DTO;

use AMQPEnvelope;

trait Queueable
{
    public static function fromEnvelope(AMQPEnvelope $message): self
    {
        $data = json_decode($message->getBody(), true);

        return self::fromArray($data);
    }
}
