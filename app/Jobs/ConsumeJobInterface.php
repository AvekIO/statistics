<?php
declare(strict_types=1);

namespace App\Jobs;

interface ConsumeJobInterface
{
    public function handle(): void;
}
