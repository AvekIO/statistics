<?php
declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class FlowBlockStatisticsFactory extends Factory implements DatabaseFactoryInterface
{
    public function definition(): array
    {
        return [
            'flow_id' => $this->faker->numberBetween(0, self::INT_SMALL_UNSIGNED_MAX_VALUE),
            'block_id' => $this->faker->numberBetween(0, self::INT_MEDIUM_UNSIGNED_MAX_VALUE),
            'message_id' => $this->faker->numberBetween(0, self::INT_BIG_UNSIGNED_MAX_VALUE),
            'triggered_at' => $this->faker->dateTimeBetween('-1 year'),
        ];
    }
}
