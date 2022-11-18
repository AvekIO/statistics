<?php
declare(strict_types=1);

namespace Tests\Functional;

use App\Models\FlowCommandsStatistics;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class FlowCommandsStatisticsTest extends TestCase
{
    use DatabaseMigrations;

    private const API_ENDPOINT = '/flows/{flow_id}/commands/{command_id?}';

    public function test_endpoint_returns_empty_json_when_flow_id_is_not_exists_in_database()
    {
        $response = $this->get($this->buildUrl());

        $response->assertStatus(200);
        $response->assertExactJson([]);
    }

    public function test_endpoint_returns_json_with_data_when_flow_id_is_exists_in_database()
    {
        $flowCommandStatistics = FlowCommandsStatistics::factory()->create();

        $response = $this->get($this->buildUrl($flowCommandStatistics->flow_id));

        $response->assertStatus(200);
        $response->assertExactJson([$flowCommandStatistics->toArray()]);
    }

    public function test_endpoint_returns_json_with_sorted_data_when_many_flow_id_is_exists_in_database()
    {
        $flowId = rand();
        $flowCommandStatistics = FlowCommandsStatistics::factory()->count(5)->create([
            'flow_id' => $flowId,
        ]);
        $sortedBotStatistics = $flowCommandStatistics->sortBy('triggered_at')->values()->toArray();

        $response = $this->get($this->buildUrl($flowId));

        $response->assertStatus(200);
        $response->assertExactJson($sortedBotStatistics);
    }

    public function test_endpoint_returns_empty_json_when_flow_id_with_this_command_id_is_not_exists_in_database()
    {
        $flowCommandStatistics = FlowCommandsStatistics::factory()->create();

        $response = $this->get($this->buildUrl($flowCommandStatistics->flow_id, rand()));

        $response->assertStatus(200);
        $response->assertExactJson([]);
    }

    public function test_endpoint_returns_json_with_data_when_flow_id_with_this_command_id_is_exists_in_database()
    {
        $flowCommandStatistics = FlowCommandsStatistics::factory()->create();

        $response = $this->get($this->buildUrl($flowCommandStatistics->flow_id, $flowCommandStatistics->command_id));

        $response->assertStatus(200);
        $response->assertExactJson([$flowCommandStatistics->toArray()]);
    }

    public function test_endpoint_returns_json_with_sorted_data_when_many_flow_id_with_this_command_id_is_exists_in_database()
    {
        $flowId = rand();
        $commandId = rand();
        $flowCommandStatistics = FlowCommandsStatistics::factory()->count(5)->create([
            'flow_id' => $flowId,
            'command_id' => $commandId,
        ]);
        $sortedBotStatistics = $flowCommandStatistics->sortBy('triggered_at')->values()->toArray();

        $response = $this->get($this->buildUrl($flowId, $commandId));

        $response->assertStatus(200);
        $response->assertExactJson($sortedBotStatistics);
    }

    public function test_endpoint_returns_error_when_triggered_at_query_param_is_invalid()
    {
        $url = $this->buildUrl() . "?triggered_at_from=123&triggered_at_to=asd";

        $response = $this->get($url);

        $response->assertStatus(422);
        $response->assertExactJson([
            'errors' => [
                'triggered_at_from' => [
                    'validation.date_format',
                ],
                'triggered_at_to' => [
                    'validation.date_format',
                ],
            ],
            'status' => true,
        ]);
    }

    public function test_endpoint_returns_json_with_data_that_filtered_by_triggered_at_query_param()
    {
        $flowId = rand();
        $triggeredAtFromQueryParam = '2021-01-01 00:00:00';
        $triggeredAtToQueryParam = '2021-12-31 23:00:00';
        $triggeredAtValues = [
            'before_from' => '2020-06-01 00:00:00',
            'between_from_and_to' => '2021-06-01 00:00:00',
            'after_to' => '2022-06-01 00:00:00',
        ];
        $url = $this->buildUrl($flowId) . "?triggered_at_from=$triggeredAtFromQueryParam&triggered_at_to=$triggeredAtToQueryParam";

        foreach ($triggeredAtValues as $triggeredAt) {
            FlowCommandsStatistics::factory()->create([
                'flow_id' => $flowId,
                'triggered_at' => $triggeredAt,
            ]);
        }

        $response = $this->get($url);

        $response->assertStatus(200);
        $response->assertJsonCount(1);
        $this->assertTrue($response->json('0.triggered_at') === $triggeredAtValues['between_from_and_to']);
    }

    private function buildUrl(int $flowId = null, int $commandId = null): string
    {
        $flowId ??= rand();

        return str_replace(['{flow_id}', '{command_id?}'], [$flowId, $commandId], self::API_ENDPOINT);
    }
}
