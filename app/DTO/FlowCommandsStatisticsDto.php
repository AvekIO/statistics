<?php
declare(strict_types=1);

namespace App\DTO;

use Illuminate\Http\Request;

class FlowCommandsStatisticsDto
{
    public function __construct(
        public readonly int $flowId,
        public readonly ?int $commandId,
        public readonly ?string $createdAtFrom,
        public readonly ?string $createdAtTo
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            $request->integer('flow_id'),
            $request->input('command_id') ? $request->integer('command_id') : null,
            $request->input('created_at_from'),
            $request->input('created_at_to'),
        );
    }
}
