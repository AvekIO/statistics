<?php
declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class FlowTelegramUsersStatisticsFactory extends Factory implements DatabaseFactoryInterface
{
    public function definition(): array
    {
        return [
            'flow_id' => rand(0, self::INT_SMALL_UNSIGNED_MAX_VALUE),
            'telegram_user_id' => rand(0, self::INT_BIG_UNSIGNED_MAX_VALUE),
            'sent' => rand(0, self::INT_SMALL_UNSIGNED_MAX_VALUE),
            'received' => rand(0, self::INT_SMALL_UNSIGNED_MAX_VALUE),
            'space_used' => rand(0, self::INT_MEDIUM_UNSIGNED_MAX_VALUE),
            'subscribed_at' => $this->faker->dateTimeBetween('-1 year'),
        ];
    }
}
