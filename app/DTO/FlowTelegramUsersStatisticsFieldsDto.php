<?php
declare(strict_types=1);

namespace App\DTO;

class FlowTelegramUsersStatisticsFieldsDto implements QueueableDtoInterface
{
    use Queueable;

    public function __construct(
        public readonly int $flowId,
        public readonly int $telegramUserId,
        public readonly int $sent,
        public readonly int $received,
        public readonly int $spaceUsed,
        public readonly string $subscribedAt
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            $data['flow_id'],
            $data['telegram_user_id'],
            $data['sent'],
            $data['received'],
            $data['space_used'],
            $data['subscribed_at']
        );
    }
}
