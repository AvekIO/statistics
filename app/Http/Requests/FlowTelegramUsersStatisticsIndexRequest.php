<?php
declare(strict_types=1);

namespace App\Http\Requests;

class FlowTelegramUsersStatisticsIndexRequest extends AbstractRequest
{
    public function rules(): array
    {
        return [
            'subscribed_at_from' => 'nullable|date_format:Y-m-d H:i:s',
            'subscribed_at_to' => 'nullable|date_format:Y-m-d H:i:s',
        ];
    }
}
