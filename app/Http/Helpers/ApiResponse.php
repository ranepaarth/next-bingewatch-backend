<?php

namespace App\Http\Helpers;

class ApiResponse
{
    public static function successResponse($data, $message)
    {
        $response = [
            'status' => true,
            'data' => $data,
            'message' => $message
        ];
        return response()->json($response, 200);
    }

    public static function errorResponse($data, $message, $code = 500)
    {
        $response = [
            'status' => false,
            'data' => $data,
            'message' => $message
        ];
        return response()->json($response, $code);
    }
}
