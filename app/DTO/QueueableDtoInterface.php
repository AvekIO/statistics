<?php
declare(strict_types=1);

namespace App\DTO;

use AMQPEnvelope;

interface QueueableDtoInterface
{
    public static function fromEnvelope(AMQPEnvelope $message): self;
}
