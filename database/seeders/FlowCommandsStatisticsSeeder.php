<?php
declare(strict_types=1);

namespace Database\Seeders;

use App\Models\FlowCommandsStatistics;
use Illuminate\Database\Seeder;

class FlowCommandsStatisticsSeeder extends Seeder
{
    private const TABLE_SEED_COUNT = 10000;

    public function run(): void
    {
        FlowCommandsStatistics::factory()->count(self::TABLE_SEED_COUNT)->create();
    }
}
