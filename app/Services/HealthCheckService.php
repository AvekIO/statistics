<?php
declare(strict_types=1);

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class HealthCheckService
{
    private bool $status = true;

    public function getStatus(): array
    {
        return [
            'mysql_status' => $this->getMysqlStatus(),
            'redis_status' => $this->getRedisStatus(),
            'status' => $this->status,
        ];
    }

    private function getMysqlStatus(): bool|string
    {
        return $this->wrapCheck(fn () => (bool) DB::connection()->getPDO());
    }

    private function getRedisStatus(): bool|string
    {
        return $this->wrapCheck(fn () => (bool) Redis::connection('cache'));
    }

    private function wrapCheck(callable $func): bool|string
    {
        try {
            return $func();
        } catch (Exception $exception){
            $this->status = false;

            return $exception->getMessage();
        }
    }
}
