<?php
declare(strict_types=1);

namespace App\DTO;

class FlowCommandsStatisticsDto
{
    public function __construct(
        public readonly int $flowId,
        public readonly ?int $commandId,
        public readonly ?string $createdAtFrom,
        public readonly ?string $createdAtTo
    ) {}
}
