<?php
declare(strict_types=1);

namespace App\Http\Requests;

class FlowBlockStatisticsIndexRequest extends AbstractRequest
{
    public function rules(): array
    {
        return [
            'flow_id' => 'required|integer',
            'block_id' => 'nullable|integer',
            'created_at_from' => 'nullable|date_format:Y-m-d H:i:s',
            'created_at_to' => 'nullable|date_format:Y-m-d H:i:s',
        ];
    }
}
