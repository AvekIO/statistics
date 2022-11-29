<?php
declare(strict_types=1);

namespace App\DTO;

class FlowBlocksStatisticsFieldsDto
{
    use Queueable;

    public function __construct(
        public readonly int $flowId,
        public readonly int $blockId,
        public readonly int $messageId,
        public readonly string $triggeredAt
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            $data['flow_id'],
            $data['block_id'],
            $data['message_id'],
            $data['triggered_at']
        );
    }
}
