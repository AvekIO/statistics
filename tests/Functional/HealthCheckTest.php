<?php
declare(strict_types=1);

namespace Tests\Functional;

use Tests\TestCase;

class HealthCheckTest extends TestCase
{
    private const API_ENDPOINT = '/health-check';

    public function test_endpoint_returns_success_status_key_by_default()
    {
        $response = $this->get(self::API_ENDPOINT);

        $response->assertStatus(200);
        $response->assertExactJson([
            'db_status' => true,
            'cache_status' => true,
            'status' => true,
        ]);
    }

    public function test_endpoint_returns_failed_status_key_when_db_connection_is_broken()
    {
        config(['database.connections' => null]);

        $response = $this->get(self::API_ENDPOINT);

        $response->assertStatus(200);
        $this->assertNotTrue($response->json('db_status'));
        $this->assertFalse($response->json('status'));
    }

    public function test_endpoint_returns_failed_status_key_when_cache_connection_is_broken()
    {
        config(['cache.stores' => null]);

        $response = $this->get(self::API_ENDPOINT);

        $response->assertStatus(200);
        $this->assertNotTrue($response->json('cache_status'));
        $this->assertFalse($response->json('status'));
    }
}
