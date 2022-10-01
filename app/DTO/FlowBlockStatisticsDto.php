<?php
declare(strict_types=1);

namespace App\DTO;

use Illuminate\Http\Request;

class FlowBlockStatisticsDto
{
    public function __construct(
        public readonly int $flowId,
        public readonly ?int $blockId,
        public readonly ?string $createdAtFrom,
        public readonly ?string $createdAtTo
    ) {}
}
