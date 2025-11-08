<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

/**
 * Class BaseController
 *
 * This is the base controller for all API controllers.
 * It ensures that all API responses are consistent and returned as JSON.
 * Extend this controller for all API endpoints instead of the default Controller.
 */
class BaseController extends Controller
{
    use ApiResponseTrait;

    /**
     * Handle validation errors and return standardized response.
     *
     * @param \Illuminate\Validation\ValidationException $exception
     * @return JsonResponse
     */
    protected function handleValidationException(\Illuminate\Validation\ValidationException $exception): JsonResponse
    {
        return $this->error('Validation failed', $exception->errors(), 422);
    }

    /**
     * Handle unauthorized access.
     *
     * @param string $message
     * @return JsonResponse
     */
    protected function unauthorized(string $message = 'Unauthorized access'): JsonResponse
    {
        return $this->error($message, [], 401);
    }

    /**
     * Handle forbidden access.
     *
     * @param string $message
     * @return JsonResponse
     */
    protected function forbidden(string $message = 'Forbidden access'): JsonResponse
    {
        return $this->error($message, [], 403);
    }
}
