<?php
declare(strict_types=1);

namespace App\DTO;

class FlowBlockStatisticsDto
{
    public function __construct(
        public readonly int $flowId,
        public readonly ?int $blockId,
        public readonly ?string $triggeredAtFrom,
        public readonly ?string $triggeredAtTo
    ) {}
}
