<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

abstract class AbstractModel extends Model
{
    use HasFactory;

    protected $casts = [
        'created_at'  => 'datetime:Y-m-d H:i:s',
    ];
}
