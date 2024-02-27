<?php

namespace App\Http\Response;

class CommonResponse
{
    public static function success($message = null, $data = null)
    {
        return response()->json([
            'status' => 'success',
            'message' => $message,
            'data' => $data
        ], 200);
    }

    public static function successForMessage($message)
    {
        return response()->json([
            'status' => 'success',
            'message' => $message
        ], 200);
    }

    public static function successForData($data)
    {
        return response()->json([
            'status' => 'success',
            'data' => $data
        ], 200);
    }

    public static function error($message)
    {
        return response()->json([
            'status' => 'error',
            'message' => $message
        ], 200);
    }
}