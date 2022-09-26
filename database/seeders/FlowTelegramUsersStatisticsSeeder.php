<?php
declare(strict_types=1);

namespace Database\Seeders;

use App\Models\FlowTelegramUsersStatistics;
use Illuminate\Database\Seeder;

class FlowTelegramUsersStatisticsSeeder extends Seeder
{
    private const TABLE_SEED_COUNT = 10000;

    public function run()
    {
        FlowTelegramUsersStatistics::factory()->count(self::TABLE_SEED_COUNT)->create();
    }
}
