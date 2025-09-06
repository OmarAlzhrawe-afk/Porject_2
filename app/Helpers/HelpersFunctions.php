<?php

namespace App\Helpers;

use Illuminate\Http\Request;
use App\Models\Academic_year;
use App\Models\Term;

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

    public static function error($message = '', $status = 400, $errors = [])
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

    public static function getCurrentAcademicYearId()
    {
        return Academic_year::where('is_current', true)->value('id');
    }
    public static function getCurrentTermId()
    {
        return Term::where('is_current', true)->value('id');
    }
}
