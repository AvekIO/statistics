<?php
declare(strict_types=1);

namespace App\Services;

use Exception;
use Illuminate\Cache\CacheManager;
use Illuminate\Database\DatabaseManager;

class HealthCheckService
{
    private const CACHE_CHECK_KEY = 'cache_health_check';
    private const CACHE_CHECK_TTL = 30;

    private bool $status = true;

    public function __construct(private readonly DatabaseManager $db, private readonly CacheManager $cache)
    {
    }

    public function getStatus(): array
    {
        return [
            'db_status' => $this->getDbStatus(),
            'cache_status' => $this->getCacheStatus(),
            'status' => $this->status,
        ];
    }

    private function getDbStatus(): bool|string
    {
        return $this->wrapCheck(fn () => (bool) $this->db->connection()->getPDO());
    }

    private function getCacheStatus(): bool|string
    {
        return $this->wrapCheck(fn () =>
            $this->cache->remember(self::CACHE_CHECK_KEY, self::CACHE_CHECK_TTL, fn () => true)
        );
    }

    private function wrapCheck(callable $func): bool|string
    {
        try {
            return $func();
        } catch (Exception $exception) {
            $this->status = false;

            return $exception->getMessage();
        }
    }
}
