<?php
declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BotStatisticsFactory extends Factory
{
    private const BOT_TOKEN_MASK = "##########:???????????????????????????????????";
    private const MEDIUM_INT_UNSIGNED_MAX = 16777215;

    public function definition(): array
    {
        return [
            'bot_token' => $this->faker->bothify(self::BOT_TOKEN_MASK),
            'sent' => rand(0, self::MEDIUM_INT_UNSIGNED_MAX),
            'received' => rand(0, self::MEDIUM_INT_UNSIGNED_MAX),
            'triggered' => rand(0, self::MEDIUM_INT_UNSIGNED_MAX),
            'subscribed' => rand(0, self::MEDIUM_INT_UNSIGNED_MAX),
            'unsubscribed' => rand(0, self::MEDIUM_INT_UNSIGNED_MAX),
            'created_at' => $this->faker->dateTimeBetween('-1 year'),
        ];
    }
}
