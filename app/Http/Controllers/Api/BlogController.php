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
            ], 422);
        } else {

            $blog = Blog::create([
                'title' => $request->title,
                'body' => $request->body,
            ]);

            if($blog) {
                return response()->json([
                    'status' => 200,
                    'message' => "Blog Created Successfully"
                ], 200);
            } else {
                return response()->json([
                    'status' => 500,
                    'message' => "Something went wrong"
                ], 500);
            }

            
        }
    }

    public function show($id)
    {
        $blog = Blog::find($id);

        if($blog) {
            return response()->json([
                'status' => 200,
                'blog' => $blog
            ],200);
        } else {
            return response()->json([
                'status' => 500,
                'message' => "Something went wrong"
            ], 500);
        }
    }

    public function edit($id)
    {
        $blog = Blog::find($id);

        if($blog) {
            return response()->json([
                'status' => 200,
                'blog' => $blog
            ],200);
        } else {
            return response()->json([
                'status' => 500,
                'message' => "Something went wrong"
            ], 500);
        }
    }

    public function update(Request $request, int $id)
    {
        $validator = Validator::make($request->all(),[
            'title' => 'nullable|string|max:191',
            'body' => 'nullable|string|max:191',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        } else {

            $blog = Blog::find($id);

            if($blog) {
                if($request->title && $request->body){

                    $blog->update([
                        'title' => $request->title,
                        'body' => $request->body,
                    ]);
                } else if ($request->title){
                    $blog->update([
                        'title' => $request->title,
                    ]);
                } else if ($request->body){
                    $blog->update([
                        'body' => $request->body,
                    ]);
                }

                return response()->json([
                    'status' => 200,
                    'message' => "Blog Updated Successfully"
                ],200);

            } else {
                return response()->json([
                    'status' => 404,
                    'message' => "Something went wrong"
                ], 404);
            }  
        }
    }

    public function destroy($id)
    {
        $blog = Blog::find($id);

        if($blog) {
            $blog->delete();

            return response()->json([
                'status' => 200,
                'message' => "Blog successfully deleted"
            ],200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => "Something went wrong"
            ], 404);
        }
    }

}
