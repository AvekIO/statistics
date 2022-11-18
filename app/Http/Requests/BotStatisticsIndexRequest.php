<?php
declare(strict_types=1);

namespace App\Http\Requests;

class BotStatisticsIndexRequest extends AbstractRequest
{
    public function rules(): array
    {
        return [
            'date_hour_from' => 'nullable|date_format:Y-m-d H:i:s',
            'date_hour_to' => 'nullable|date_format:Y-m-d H:i:s',
        ];
    }
}
