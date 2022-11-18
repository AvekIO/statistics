<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BotStatistics extends Model
{
    use HasFactory;

    public $timestamps = false;

    public $incrementing = false;

    protected $table = 'bot_statistics';

    protected $casts = [
        'date_hour'  => 'datetime:Y-m-d H:00:00',
    ];
}
