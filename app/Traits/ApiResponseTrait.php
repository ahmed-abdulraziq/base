<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponseTrait
{
    protected function success(string $message = '', mixed $data = null, int $code = 200): JsonResponse
    {
        return response()->json([
            'status'  => true,
            'message' => $message,
            'data'    => $data,
        ], $code);
    }

    protected function error(string $message = '', array $errors = [], int $code = 400): JsonResponse
    {
        return response()->json([
            'status'  => false,
            'message' => $message,
            'errors'  => $errors,
        ], $code);
    }
}
