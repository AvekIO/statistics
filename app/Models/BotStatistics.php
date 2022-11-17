<?php
declare(strict_types=1);

namespace App\Models;

class BotStatistics extends AbstractModel
{
    public const UPDATED_AT = null;

    public $incrementing = false;

    protected $table = 'bot_statistics';
}
