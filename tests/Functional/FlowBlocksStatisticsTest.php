<?php
declare(strict_types=1);

namespace Tests\Functional;

use App\Models\FlowBlocksStatistics;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class FlowBlocksStatisticsTest extends TestCase
{
    use DatabaseMigrations;

    private const API_ENDPOINT = '/flows/{flow_id}/blocks/{block_id?}';

    public function test_endpoint_returns_empty_json_when_flow_id_is_not_exists_in_database()
    {
        $response = $this->get($this->buildUrl());

        $response->assertStatus(200);
        $response->assertExactJson([]);
    }

    public function test_endpoint_returns_json_with_data_when_flow_id_is_exists_in_database()
    {
        $flowBlocksStatistics = FlowBlocksStatistics::factory()->create();

        $response = $this->get($this->buildUrl($flowBlocksStatistics->flow_id));

        $response->assertStatus(200);
        $response->assertExactJson([$flowBlocksStatistics->toArray()]);
    }

    public function test_endpoint_returns_json_with_sorted_data_when_many_flow_id_is_exists_in_database()
    {
        $flowId = rand();
        $createdFlowBlocksStatistics = FlowBlocksStatistics::factory()->count(5)->create([
            'flow_id' => $flowId,
        ]);
        $sortedFlowBlocksStatistics = $createdFlowBlocksStatistics->sortBy('triggered_at')->values()->toArray();

        $response = $this->get($this->buildUrl($flowId));

        $response->assertStatus(200);
        $response->assertExactJson($sortedFlowBlocksStatistics);
    }

    public function test_endpoint_returns_empty_json_when_flow_id_with_this_block_id_is_not_exists_in_database()
    {
        $flowBlocksStatistics = FlowBlocksStatistics::factory()->create();

        $response = $this->get($this->buildUrl($flowBlocksStatistics->flow_id, rand()));

        $response->assertStatus(200);
        $response->assertExactJson([]);
    }

    public function test_endpoint_returns_json_with_data_when_flow_id_with_this_block_id_is_exists_in_database()
    {
        $flowBlocksStatistics = FlowBlocksStatistics::factory()->create();

        $response = $this->get($this->buildUrl($flowBlocksStatistics->flow_id, $flowBlocksStatistics->block_id));

        $response->assertStatus(200);
        $response->assertExactJson([$flowBlocksStatistics->toArray()]);
    }

    public function test_endpoint_returns_json_with_sorted_data_when_many_flow_id_with_this_block_id_is_exists_in_database()
    {
        $flowId = rand();
        $blockId = rand();
        $flowBlocksStatistics = FlowBlocksStatistics::factory()->count(5)->create([
            'flow_id' => $flowId,
            'block_id' => $blockId,
        ]);
        $flowBlocksStatistics = $flowBlocksStatistics->sortBy('triggered_at')->values()->toArray();

        $response = $this->get($this->buildUrl($flowId, $blockId));

        $response->assertStatus(200);
        $response->assertExactJson($flowBlocksStatistics);
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
            FlowBlocksStatistics::factory()->create([
                'flow_id' => $flowId,
                'triggered_at' => $triggeredAt,
            ]);
        }

        $response = $this->get($url);

        $response->assertStatus(200);
        $response->assertJsonCount(1);
        $this->assertTrue($response->json('0.triggered_at') === $triggeredAtValues['between_from_and_to']);
    }

    private function buildUrl(int $flowId = null, int $blockId = null): string
    {
        $flowId ??= rand();

        return str_replace(['{flow_id}', '{block_id?}'], [$flowId, $blockId], self::API_ENDPOINT);
    }
}
