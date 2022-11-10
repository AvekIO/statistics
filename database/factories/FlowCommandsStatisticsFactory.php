<?php
declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class FlowCommandsStatisticsFactory extends Factory implements DatabaseFactoryInterface
{
    public function definition(): array
    {
        return [
            'flow_id' => rand(0, self::INT_SMALL_UNSIGNED_MAX_VALUE),
            'command_id' => rand(0, self::INT_MEDIUM_UNSIGNED_MAX_VALUE),
            'telegram_user_id' => rand(0, self::INT_BIG_UNSIGNED_MAX_VALUE),
            'created_at' => $this->faker->dateTimeBetween('-1 year'),
        ];
    }
}
