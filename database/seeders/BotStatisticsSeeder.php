<?php
declare(strict_types=1);

namespace Database\Seeders;

use App\Models\BotStatistics;
use Illuminate\Database\Seeder;

class BotStatisticsSeeder extends Seeder
{
    private const TABLE_SEED_COUNT = 1000;

    public function run(): void
    {
        BotStatistics::factory()->count(self::TABLE_SEED_COUNT)->create();
    }
}
