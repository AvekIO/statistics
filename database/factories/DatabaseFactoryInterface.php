<?php
declare(strict_types=1);

namespace Database\Factories;

interface DatabaseFactoryInterface
{
    public const INT_SMALL_UNSIGNED_MAX_VALUE = 65535;
    public const INT_MEDIUM_UNSIGNED_MAX_VALUE = 16777215;
    public const INT_BIG_UNSIGNED_MAX_VALUE = 4294967295;
}
