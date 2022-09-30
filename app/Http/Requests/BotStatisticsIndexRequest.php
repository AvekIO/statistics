<?php
declare(strict_types=1);

namespace App\Http\Requests;

class BotStatisticsIndexRequest extends AbstractRequest
{
    public function rules(): array
    {
        return [
            'bot_token' => 'required|string',
            'created_at_from' => 'nullable|date_format:Y-m-d H:i:s',
            'created_at_to' => 'nullable|date_format:Y-m-d H:i:s',
        ];
    }
}
