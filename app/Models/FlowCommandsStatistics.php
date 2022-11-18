<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlowCommandsStatistics extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'flow_commands_statistics';

    protected $casts = [
        'triggered_at'  => 'datetime:Y-m-d H:i:s',
    ];
}
