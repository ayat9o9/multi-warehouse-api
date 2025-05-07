<?php

namespace App\Exceptions;

use Illuminate\Http\JsonResponse;

use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Throwable;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    public function render($request, Throwable $exception): JsonResponse
    {
        if ($exception instanceof ValidationException) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed.',
                'errors' => $exception->errors(),
            ], 422);
        }

        if ($exception instanceof UnauthorizedHttpException) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized access.',
            ], 401);
        }

        // Convert default response to JsonResponse
        $response = parent::render($request, $exception);

        return response()->json([
            'success' => false,
            'message' => $exception->getMessage(),
            'status' => $response->getStatusCode(),
        ], $response->getStatusCode());
    }
}
