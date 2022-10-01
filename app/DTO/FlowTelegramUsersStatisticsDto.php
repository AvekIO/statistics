<?php
declare(strict_types=1);

namespace App\DTO;

class FlowTelegramUsersStatisticsDto
{
    public function __construct(
        public readonly int $flowId,
        public readonly ?int $telegramUserId,
    ) {}
}
