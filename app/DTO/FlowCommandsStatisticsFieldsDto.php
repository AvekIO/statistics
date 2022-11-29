<?php
declare(strict_types=1);

namespace App\DTO;

class FlowCommandsStatisticsFieldsDto implements QueueableDtoInterface
{
    use Queueable;

    public function __construct(
        public readonly int $flowId,
        public readonly int $commandId,
        public readonly int $botChatTelegramUserId,
        public readonly string $triggeredAt
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            $data['flow_id'],
            $data['command_id'],
            $data['bot_chat_telegram_user_id'],
            $data['triggered_at']
        );
    }
}
