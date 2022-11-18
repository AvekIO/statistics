<?php
declare(strict_types=1);

namespace App\Models;

class FlowCommandsStatistics extends AbstractModel
{
    public $timestamps = false;

    protected $table = 'flow_commands_statistics';

    protected $casts = [
        'triggered_at'  => 'datetime:Y-m-d H:i:s',
    ];
}
