<?php
declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class FlowTelegramUsersStatisticsFactory extends Factory
{
    private const SMALL_INT_UNSIGNED_MAX = 65535;
    private const MEDIUM_INT_UNSIGNED_MAX = 16777215;
    private const BIG_INT_UNSIGNED_MAX = PHP_INT_MAX;

    public function definition(): array
    {
        return [
            'flow_id' => rand(0, self::SMALL_INT_UNSIGNED_MAX),
            'bot_chat_telegram_user_id' => rand(0, self::BIG_INT_UNSIGNED_MAX),
            'sent' => rand(0, self::SMALL_INT_UNSIGNED_MAX),
            'received' => rand(0, self::SMALL_INT_UNSIGNED_MAX),
            'space_used' => rand(0, self::MEDIUM_INT_UNSIGNED_MAX),
            'subscribed_at' => $this->faker->dateTimeBetween('-1 year'),
        ];
    }
}
