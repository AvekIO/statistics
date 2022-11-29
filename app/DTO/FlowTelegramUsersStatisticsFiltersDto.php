<?php
declare(strict_types=1);

namespace App\DTO;

class FlowTelegramUsersStatisticsFiltersDto
{
    public function __construct(
        public readonly int $flowId,
        public readonly ?int $telegramUserId,
        public readonly ?string $subscribedAtFrom,
        public readonly ?string $subscribedAtTo
    ) {}
}
