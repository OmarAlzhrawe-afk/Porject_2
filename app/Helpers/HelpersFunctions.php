<?php

namespace App\Helpers;

use Illuminate\Http\Request;

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
    public static function logout()
    {
        $request = request();
        if ($request->user()?->currentAccessToken()) {
            $request->user()->currentAccessToken()->delete();
            return HelpersFunctions::success("", "logout Done", 200);
        }
        return HelpersFunctions::error("Bad Request", 400, "No Active log in Found ");
    }
}
