<?php
declare(strict_types=1);

namespace App\DTO;

use Illuminate\Http\Request;

class BotStatisticsDto
{
    public function __construct(public string $botToken, public ?string $createdAtFrom, public ?string $createdAtTo)
    {
    }

    public static function fromRequest(Request $request): self
    {
        return new self(
            $request->input('bot_token'),
            $request->input('created_at_from'),
            $request->input('created_at_to'),
        );
    }
}
