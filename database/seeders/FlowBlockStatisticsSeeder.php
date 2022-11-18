<?php
declare(strict_types=1);

namespace Database\Seeders;

use App\Models\FlowBlocksStatistics;
use Illuminate\Database\Seeder;

class FlowBlockStatisticsSeeder extends Seeder
{
    private const TABLE_SEED_COUNT = 10000;

    public function run(): void
    {
        FlowBlocksStatistics::factory()->count(self::TABLE_SEED_COUNT)->create();
    }
}
