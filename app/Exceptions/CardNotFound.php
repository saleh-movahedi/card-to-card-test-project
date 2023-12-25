<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class CardNotFound extends Exception
{
    public function render(): Response
    {
        return response([
            'message' => $this->message ?? 'card has not found in banking system'
        ], ResponseAlias::HTTP_NOT_FOUND);

    }
}
