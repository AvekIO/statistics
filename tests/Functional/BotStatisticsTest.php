<?php
declare(strict_types=1);

namespace Tests\Functional;

use App\Models\BotStatistics;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Str;
use Tests\TestCase;

class BotStatisticsTest extends TestCase
{
    use DatabaseMigrations;

    private const API_ENDPOINT = '/bots/{bot_token}';

    public function test_endpoint_returns_empty_json_when_bot_token_is_not_exists_in_database()
    {
        $response = $this->get($this->getUrlWithBotToken());

        $response->assertStatus(200);
        $response->assertExactJson([]);
    }

    public function test_endpoint_returns_json_with_data_when_bot_token_is_exists_in_database()
    {
        $botStatistics = BotStatistics::factory()->create();

        $response = $this->get($this->getUrlWithBotToken($botStatistics->bot_token));

        $response->assertStatus(200);
        $response->assertExactJson([$botStatistics->toArray()]);
    }

    public function test_endpoint_returns_json_with_sorted_data_when_many_bot_tokens_is_exists_in_database()
    {
        $botToken = $this->generateBotToken();
        $createdBotStatistics = BotStatistics::factory()->count(5)->create([
            'bot_token' => $botToken,
        ]);
        $sortedBotStatistics = $createdBotStatistics->sortBy('date_hour')->values()->toArray();

        $response = $this->get($this->getUrlWithBotToken($botToken));

        $response->assertStatus(200);
        $response->assertExactJson($sortedBotStatistics);
    }

    public function test_endpoint_returns_error_when_date_hour_query_param_is_invalid()
    {
        $url = $this->getUrlWithBotToken($this->generateBotToken()) . "?date_hour_from=123&date_hour_to=asd";

        $response = $this->get($url);

        $response->assertStatus(422);
        $response->assertExactJson([
            'errors' => [
                'date_hour_from' => [
                    'validation.date_format',
                ],
                'date_hour_to' => [
                    'validation.date_format',
                ],
            ],
            'status' => true,
        ]);
    }

    public function test_endpoint_returns_json_with_data_that_filtered_by_date_hour_query_param()
    {
        $botToken = $this->generateBotToken();
        $dateHourFromQueryParam = '2021-01-01 00:00:00';
        $dateHourToQueryParam = '2021-12-31 23:00:00';
        $dateHoursValues = [
            'before_from' => '2020-06-01 00:00:00',
            'between_from_and_to' => '2021-06-01 00:00:00',
            'after_to' => '2022-06-01 00:00:00',
        ];
        $url = $this->getUrlWithBotToken($botToken) . "?date_hour_from=$dateHourFromQueryParam&date_hour_to=$dateHourToQueryParam";

        foreach ($dateHoursValues as $dateHour) {
            BotStatistics::factory()->create([
                'bot_token' => $botToken,
                'date_hour' => $dateHour,
            ]);
        }

        $response = $this->get($url);

        $response->assertStatus(200);
        $response->assertJsonCount(1);
        $this->assertTrue($response->json('0.date_hour') === $dateHoursValues['between_from_and_to']);
    }

    private function getUrlWithBotToken(string $botToken = null): string
    {
        return str_replace('{bot_token}', $botToken ?? $this->generateBotToken(), self::API_ENDPOINT);
    }

    private function generateBotToken(): string
    {
        return Str::random(50);
    }
}
