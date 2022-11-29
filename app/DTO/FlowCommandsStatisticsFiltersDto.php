<?php
declare(strict_types=1);

namespace App\DTO;

class FlowCommandsStatisticsFiltersDto
{
    public function __construct(
        public readonly int $flowId,
        public readonly ?int $commandId,
        public readonly ?string $triggeredAtFrom,
        public readonly ?string $triggeredAtTo
    ) {}
}
