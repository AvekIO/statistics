<?php
declare(strict_types=1);

namespace App\Http\Requests;

class FlowTelegramUsersStatisticsIndexRequest extends AbstractRequest
{
    public function rules(): array
    {
        return [
            'flow_id' => 'required|integer',
            'bot_chat_telegram_user_id' => 'nullable|integer',
        ];
    }
}
