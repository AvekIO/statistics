<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlowBlocksStatistics extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'flow_block_statistics';

    protected $casts = [
        'triggered_at'  => 'datetime:Y-m-d H:i:s',
    ];
}
