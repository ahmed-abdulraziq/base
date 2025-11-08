<?php

namespace App\Exceptions;

use App\Traits\ApiResponseTrait;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Access\AuthorizationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Http\Request;
use Throwable;

class ApiExceptionHandler
{
    use ApiResponseTrait;

    public function handle(Throwable $e, Request $request = null)
    {
        // إذا لم يكن الـ request موجود أو لم يكن API request، نترك Laravel يتعامل معه
        if (!$request || !$request->expectsJson()) {
            return null;
        }

        if ($e instanceof ValidationException) {
            return $this->error('Validation failed', $e->errors(), 422);
        }

        if ($e instanceof AuthenticationException) {
            return $this->error('Unauthenticated', [], 401);
        }

        if ($e instanceof AuthorizationException) {
            return $this->error('Forbidden', [], 403);
        }

        if ($e instanceof NotFoundHttpException) {
            return $this->error('Resource not found', [], 404);
        }

        if ($e instanceof HttpException) {
            return $this->error($e->getMessage() ?: 'HTTP error occurred', [], $e->getStatusCode());
        }

        // للـ errors الأخرى، نرجع null ليترك Laravel يتعامل معها
        return null;
    }
}
