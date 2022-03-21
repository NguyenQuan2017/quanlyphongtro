<?php

namespace App\Traits;

trait ApiResponse {

    protected function successResponse($data, $message = null, $code = 200)
    {
        return response()->json([
            'status'=> 'Success',
            'message' => $message,
            'data' => $data
        ], $code);
    }

    protected function errorResponse($message = null, $code = 422)
    {
        return response()->json([
            'status'=>'Error',
            'message' => $message,
            'data' => null
        ], $code);
    }
}
