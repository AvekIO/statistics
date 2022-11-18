<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlowTelegramUsersStatistics extends Model
{
    use HasFactory;

    public $timestamps = false;

    public $incrementing = false;

    protected $table = 'flow_telegram_users_statistics';

    protected $casts = [
        'subscribed_at'  => 'datetime:Y-m-d H:i:s',
    ];
}
