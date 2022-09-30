<?php
declare(strict_types=1);

namespace App\DTO;

use Illuminate\Http\Request;

class FlowTelegramUsersStatisticsDto
{
    public function __construct(
        public readonly int $flowId,
        public readonly ?int $botChatTelegramUserId,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            $request->integer('flow_id'),
            $request->input('bot_chat_telegram_user_id')
                ? $request->integer('bot_chat_telegram_user_id')
                : null
        );
    }
}
