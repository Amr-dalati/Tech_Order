<?php

namespace App\Traits;

trait ApiResponseTrait
{
    public function ApiResponse($data, $message, $status = 200, $success = true)
    {
        $responseData = [
            'data' => $data,
            'message' => $message,
            'status' => $status,
            'success' => $success,
        ];
        return response()->json($responseData, $status);
    }
}
