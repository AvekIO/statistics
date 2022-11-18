<?php
declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BotStatisticsFactory extends Factory implements DatabaseFactoryInterface
{
    private const BOT_TOKEN_MASK = "##########:???????????????????????????????????";

    public function definition(): array
    {
        return [
            'bot_token' => $this->faker->bothify(self::BOT_TOKEN_MASK),
            'sent' => $this->faker->numberBetween(0, self::INT_MEDIUM_UNSIGNED_MAX_VALUE),
            'received' => $this->faker->numberBetween(0, self::INT_MEDIUM_UNSIGNED_MAX_VALUE),
            'triggered' => $this->faker->numberBetween(0, self::INT_MEDIUM_UNSIGNED_MAX_VALUE),
            'subscribed' => $this->faker->numberBetween(0, self::INT_MEDIUM_UNSIGNED_MAX_VALUE),
            'unsubscribed' => $this->faker->numberBetween(0, self::INT_MEDIUM_UNSIGNED_MAX_VALUE),
            'date_hour' => $this->faker->dateTimeBetween('-1 year')->format('Y-m-d H:00:00'),
        ];
    }
}
