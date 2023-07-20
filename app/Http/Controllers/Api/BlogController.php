<?php

namespace App\Http\Controllers\Api;

use App\Models\Blog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::all();

        if($blogs->count()>0){

            return response()->json([
                'status' => 200,
                'blogs' => $blogs,
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No Records Found'
            ], 404);
        };
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'title' => 'required|string|max:191',
            'body' => 'required|string|max:191',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ]);
        } else {

            $student = Blog::create([
                'title' => $request->title,
                'body' => $request->body,
            ]);

            if($student) {
                return response()->json([
                    'status' => 200,
                    'message' => "Blog Created Successfully"
                ]);
            } else {
                return response()->json([
                    'status' => 500,
                    'message' => "Something went wrong"
                ]);
            }

            
        }
    }
}
