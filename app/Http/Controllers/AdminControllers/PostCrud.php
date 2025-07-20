<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\School_post;
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use App\Helpers\HelpersFunctions;

class PostCrud extends Controller
{
    // CRUD Post
    public function get_Posts()
    {
        try {
            $posts = School_post::all();
            $user = auth('sanctum')->user();
            activity()->causedBy($user)->withProperties([
                'Process_type' => "get_Posts",
            ])->log("Admin get_Posts");
            return HelpersFunctions::success($posts, "Getting posts Successfully", 200);
        } catch (Exception $e) {
            return HelpersFunctions::error("Internal Server Error ", $e->getMessage(), 500);
        }
    }
    public function add_Post(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'title' =>  'required',
                'description' =>  'required',
                'post_type' =>  'required|in:lesson,news,event',
                'file_url' =>  'required|file|mimes:jpg,jpeg,png,pdf,docx,mp4,mov,avi,wmv|max:2048 ',
                'is_public' =>  'required|in:true,false',
            ]);
            if ($validator->fails()) {
                return HelpersFunctions::error("Bad Request", $validator->errors(), 400);
            } else {
                $post = new School_post();
                $post->title = $request->input('title');
                $post->description = $request->input('description');
                $post->post_type = $request->input('post_type');
                if ($request->input('is_public' == 'true')) {
                    $post->is_public = true;
                } else {
                    $post->is_public = false;
                }
                if ($request->hasFile('file_url')) {
                    $file = $request->file('file_url');
                    $file_Name = time() . '_' . $file->getClientOriginalName();
                    $file->move(public_path('uploads/Posts/'), $file_Name);
                    $post->file_url = 'uploads/Posts/' . $file_Name;
                }
                $post->save();
                $user = auth('sanctum')->user();
                activity()->causedBy($user)->withProperties([
                    'Process_type' => "add_Post",
                ])->log("Admin add_Post");
                return HelpersFunctions::success(null, "Added Post Successfully", 200);
            }
        } catch (Exception $e) {
            return HelpersFunctions::error("Internal Server Error ", $e->getMessage(), 500);
        }
    }
    public function update_Post(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'post_id' =>  'required|exists:school_posts,id',
                'title' =>  'required',
                'description' =>  'required',
                'post_type' =>  'required|in:lesson,news,event',
                'file_url' =>  'required|file|mimes:jpg,jpeg,png,pdf,docx,mp4,mov,avi,wmv|max:2048 ',
                'is_public' =>  'required|in:true,false',
            ]);
            if ($validator->fails()) {
                return HelpersFunctions::error("Bad Request", $validator->errors(), 400);
            } else {

                $post = School_post::find($request->post_id)->first();
                $post->title = $request->input('title');
                $post->description = $request->input('description');
                $post->post_type = $request->input('post_type');
                if ($request->input('is_public' == 'true')) {
                    $post->is_public = true;
                } else {
                    $post->is_public = false;
                }
                if ($request->hasFile('file_url')) {
                    //Delete old File
                    $path = public_path($post->file_url);
                    if (File::exists($path)) {
                        File::delete($path);
                    }
                    //Store new file 
                    $file = $request->file('file_url');
                    $file_Name = time() . '_' . $file->getClientOriginalName();
                    $file->move(public_path('uploads/Posts/'), $file_Name);
                    $post->file_url = 'uploads/Posts/' . $file_Name;
                }
                $post->save();
                $user = auth('sanctum')->user();
                activity()->causedBy($user)->withProperties([
                    'Process_type' => "update_Post",
                ])->log("Admin update_Post");
                return HelpersFunctions::success(null, "Update Post Successfully", 200);
            }
        } catch (Exception $e) {
            return HelpersFunctions::error("Internal Server Error ", $e->getMessage(), 500);
        }
    }
    public function delete_Post($post_id)
    {
        try {
            $post = School_post::findOrFail($post_id);
            if ($post) {
                $post->delete();
                //Delete old File
                $path = public_path($post->file_url);
                if (File::exists($path)) {
                    File::delete($path);
                }
                $user = auth('sanctum')->user();
                activity()->causedBy($user)->withProperties([
                    'Process_type' => "delete_Post",
                ])->log("Admin delete_Post");
                return HelpersFunctions::success(null, "", 204);
            } else {
                return HelpersFunctions::error("Bad Request", 400, "Post that you Eant Not Found ");
            }
        } catch (Exception $e) {
            return HelpersFunctions::error("Internal Server Error ", 500, $e->getMessage());
        }
    }
}
