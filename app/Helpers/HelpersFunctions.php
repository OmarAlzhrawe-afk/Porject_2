<?php

namespace App\Helpers;

class HelpersFunctions
{
    public static function success($data = null, $message = 'تم بنجاح', $status = 200)
    {
        return response()->json([
            'status' => true,
            'message' => $message,
            'data' => $data,
        ], $status);
    }

    public static function error($message = 'حدث خطأ ما', $status = 400, $errors = null)
    {
        return response()->json([
            'status' => false,
            'message' => $message,
            'errors' => $errors,
        ], $status);
    }
}
