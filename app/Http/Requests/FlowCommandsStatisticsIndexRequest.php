<?php
declare(strict_types=1);

namespace App\Http\Requests;

class FlowCommandsStatisticsIndexRequest extends AbstractRequest
{
    public function rules(): array
    {
        return [
            'triggered_at_from' => 'nullable|date_format:Y-m-d H:i:s',
            'triggered_at_to' => 'nullable|date_format:Y-m-d H:i:s',
        ];
    }
}
