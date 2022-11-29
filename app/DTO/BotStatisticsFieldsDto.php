<?php
declare(strict_types=1);

namespace App\DTO;

class BotStatisticsFieldsDto implements QueueableDtoInterface
{
    use Queueable;

    public function __construct(
        public readonly string $botToken,
        public readonly int $sent,
        public readonly int $received,
        public readonly int $triggered,
        public readonly int $subscribed,
        public readonly int $unsubscribed,
        public readonly string $dateHour
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            $data['bot_token'],
            $data['sent'],
            $data['received'],
            $data['triggered'],
            $data['subscribed'],
            $data['unsubscribed'],
            $data['date_hour']
        );
    }
}
