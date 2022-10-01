<?php
declare(strict_types=1);

namespace App\Http\Responses;

use Symfony\Component\HttpFoundation\Response;

class NotFoundResponse extends Response
{
    private const MESSAGE = 'Not found';
    protected const CODE = Response::HTTP_NOT_FOUND;

    public function __construct()
    {
        parent::__construct(self::MESSAGE, self::CODE);
    }
}
