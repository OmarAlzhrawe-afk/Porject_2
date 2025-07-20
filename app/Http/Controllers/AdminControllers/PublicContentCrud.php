<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Public_content;
use Exception;
use Illuminate\Support\Facades\Validator;
use App\Helpers\HelpersFunctions;



class PublicContentCrud extends Controller
{
    // CRUD Public Content
    public function get_public_content()
    {
        try {
            $public_content = Public_content::all();
            $user = auth('sanctum')->user();
            activity()->causedBy($user)->withProperties([
                'Process_type' => "get_public_content",
            ])->log("Admin get_public_content");
            return HelpersFunctions::success($public_content, "Getting posts Successfully", 200);
        } catch (Exception $e) {
            return HelpersFunctions::error("Internal Server Error", 500, $e->getMessage());
        }
    }
    public function add_PublicContent(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'content_type' =>  'required|in:about,vision,Frequently_asked_questions',
                'content' =>  'required',
            ]);
            if ($validator->fails()) {
                return HelpersFunctions::error("Validation Error Bad Request", 400, $validator->errors());
            } else {
                $public_content = new Public_content();
                $public_content->content_type = $request->input('content_type');
                $public_content->content = $request->input('content');
                $public_content->save();
                $user = auth('sanctum')->user();
                activity()->causedBy($user)->withProperties([
                    'Process_type' => "add_PublicContent",
                ])->log("Admin add_PublicContent");
                return HelpersFunctions::success(null, 'Content Added Successfully', 201);
            }
        } catch (Exception $e) {
            return HelpersFunctions::error("Internal Server Error", 500, $e->getMessage());
        }
    }
    public function update_PublicContent(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'content_id' =>  'required|exists:public_contents,id',
                'content_type' =>  'required|in:about,vision,Frequently_asked_questions',
                'content' =>  'required',
            ]);
            if ($validator->fails()) {
                return HelpersFunctions::error("Validation Error Bad Request", 400, $validator->errors());
            } else {
                $public_content = Public_content::find($request->content_id)->first();
                $public_content->content_type = $request->input('content_type');
                $public_content->content = $request->input('content');
                $public_content->save();
                $user = auth('sanctum')->user();
                activity()->causedBy($user)->withProperties([
                    'Process_type' => "update_PublicContent",
                ])->log("Admin update_PublicContent");
                return HelpersFunctions::success(null, 'Content Updated Successfully', 201);
            }
        } catch (Exception $e) {
            return HelpersFunctions::error("Internal Server Error", 500, $e->getMessage());
        }
    }
    public function delete_PublicContent($public_content_id)
    {
        try {
            $public_content = Public_content::where('id', $public_content_id)->first();
            if ($public_content) {
                $public_content->delete();
                $user = auth('sanctum')->user();
                activity()->causedBy($user)->withProperties([
                    'Process_type' => "delete_PublicContent",
                ])->log("Admin delete_PublicContent");
                return HelpersFunctions::success(null, '', 204);
            } else {
                return HelpersFunctions::error("Bad Request", 400, "public Content that You Entered Is Not Found");
            }
        } catch (Exception $e) {
            return HelpersFunctions::error("Internal Server Error", 500, $e->getMessage());
        }
    }
}
