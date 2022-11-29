<?php
declare(strict_types=1);

namespace App\DTO;

class BotStatisticsFiltersDto
{
    public function __construct(
        public readonly string $botToken,
        public readonly ?string $dateHourFrom,
        public readonly ?string $dateHourTo
    ) {}
}
