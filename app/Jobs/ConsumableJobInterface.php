<?php
declare(strict_types=1);

namespace App\Jobs;

interface ConsumableJobInterface
{
    public function handle(): void;
}
