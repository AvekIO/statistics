<?php
declare(strict_types=1);

namespace App\Models;

class BotStatistics extends AbstractModel
{
    public $timestamps = false;

    public $incrementing = false;

    protected $table = 'bot_statistics';

    protected $casts = [
        'date_hour'  => 'datetime:Y-m-d H:00:00',
    ];
}
