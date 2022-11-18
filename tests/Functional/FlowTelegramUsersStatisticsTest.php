<?php
declare(strict_types=1);

namespace Tests\Functional;

use App\Models\FlowTelegramUsersStatistics;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class FlowTelegramUsersStatisticsTest extends TestCase
{
    use DatabaseMigrations;

    private const API_ENDPOINT = '/flows/{flow_id}/telegram-users/{telegram_user_id?}';

    public function test_endpoint_returns_empty_json_when_flow_id_is_not_exists_in_database()
    {
        $response = $this->get($this->buildUrl());

        $response->assertStatus(200);
        $response->assertExactJson([]);
    }

    public function test_endpoint_returns_json_with_data_when_flow_id_is_exists_in_database()
    {
        $flowTelegramUsersStatistics = FlowTelegramUsersStatistics::factory()->create();

        $response = $this->get($this->buildUrl($flowTelegramUsersStatistics->flow_id));

        $response->assertStatus(200);
        $response->assertExactJson([$flowTelegramUsersStatistics->toArray()]);
    }

    public function test_endpoint_returns_json_with_sorted_data_when_many_flow_id_is_exists_in_database()
    {
        $flowId = rand();
        $createdFlowTelegramUsersStatistics = FlowTelegramUsersStatistics::factory()->count(5)->create([
            'flow_id' => $flowId,
        ]);
        $sortedFlowTelegramUsersStatistics = $createdFlowTelegramUsersStatistics->sortByDesc('subscribed_at')->values()->toArray();

        $response = $this->get($this->buildUrl($flowId));

        $response->assertStatus(200);
        $response->assertExactJson($sortedFlowTelegramUsersStatistics);
    }

    public function test_endpoint_returns_empty_json_when_flow_id_with_this_telegram_user_id_is_not_exists_in_database()
    {
        $flowTelegramUsersStatistics = FlowTelegramUsersStatistics::factory()->create();

        $response = $this->get($this->buildUrl($flowTelegramUsersStatistics->flow_id, rand()));

        $response->assertStatus(200);
        $response->assertExactJson([]);
    }

    public function test_endpoint_returns_json_with_data_when_flow_id_with_this_telegram_user_id_is_exists_in_database()
    {
        $flowTelegramUsersStatistics = FlowTelegramUsersStatistics::factory()->create();

        $response = $this->get($this->buildUrl($flowTelegramUsersStatistics->flow_id, $flowTelegramUsersStatistics->telegram_user_id));

        $response->assertStatus(200);
        $response->assertExactJson([$flowTelegramUsersStatistics->toArray()]);
    }

    public function test_endpoint_returns_error_when_subscribed_at_query_param_is_invalid()
    {
        $url = $this->buildUrl() . "?subscribed_at_from=123&subscribed_at_to=asd";

        $response = $this->get($url);

        $response->assertStatus(422);
        $response->assertExactJson([
            'errors' => [
                'subscribed_at_from' => [
                    'validation.date_format',
                ],
                'subscribed_at_to' => [
                    'validation.date_format',
                ],
            ],
            'status' => true,
        ]);
    }

    public function test_endpoint_returns_json_with_data_that_filtered_by_subscribed_at_query_param()
    {
        $flowId = rand();
        $triggeredAtFromQueryParam = '2021-01-01 00:00:00';
        $triggeredAtToQueryParam = '2021-12-31 23:00:00';
        $triggeredAtValues = [
            'before_from' => '2020-06-01 00:00:00',
            'between_from_and_to' => '2021-06-01 00:00:00',
            'after_to' => '2022-06-01 00:00:00',
        ];
        $url = $this->buildUrl($flowId) . "?subscribed_at_from=$triggeredAtFromQueryParam&subscribed_at_to=$triggeredAtToQueryParam";

        foreach ($triggeredAtValues as $triggeredAt) {
            FlowTelegramUsersStatistics::factory()->create([
                'flow_id' => $flowId,
                'subscribed_at' => $triggeredAt,
            ]);
        }

        $response = $this->get($url);

        $response->assertStatus(200);
        $response->assertJsonCount(1);
        $this->assertTrue($response->json('0.subscribed_at') === $triggeredAtValues['between_from_and_to']);
    }

    private function buildUrl(int $flowId = null, int $telegramUserId = null): string
    {
        $flowId ??= rand();

        return str_replace(['{flow_id}', '{telegram_user_id?}'], [$flowId, $telegramUserId], self::API_ENDPOINT);
    }
}
