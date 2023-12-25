<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class NotEnoughBalance extends Exception
{
    public function render(): Response
    {
        return response([
            'message' => 'not enough balance'
        ], ResponseAlias::HTTP_BAD_REQUEST);

    }
}
