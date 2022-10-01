<?php
declare(strict_types=1);

namespace App\DTO;

class BotStatisticsDto
{
    public function __construct(
        public readonly string $botToken,
        public readonly ?string $createdAtFrom,
        public readonly ?string $createdAtTo
    ) {}
}