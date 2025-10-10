<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        // توحيد شكل أخطاء التحقق (Validation Errors)
        $this->renderable(function (ValidationException $e, $request) {
            if ($request->expectsJson()) {
                return response()->json([
                    'status'  => false,
                    'message' => 'Validation error',
                    'errors'  => $e->errors(),
                ], 422);
            }
        });

        // مثال عام لأي خطأ غير متوقع
        $this->renderable(function (Throwable $e, $request) {
            if ($request->expectsJson()) {
                return response()->json([
                    'status'  => false,
                    'message' => $e->getMessage() ?: 'Something went wrong',
                ], 500);
            }
        });
    }
}
