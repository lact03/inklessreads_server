<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\RegisteredUser;
use App\Http\Controllers\Controller;

class RegisteredUserController extends Controller
{
    public function index()
    {
        $blogs = RegisteredUser::all();

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
        // $validator = Validator::make($request->all(),[
        //     'first_name' => 'required|string|max:191',
        //     'last_name' => 'required|string|max:191',
        //     'age' => 'required|integer|max:191',
        //     'email' => 'required|string|max:191',
        //     'password' => 'required|string|max:191',
        //     'mobile_number' => 'required|integer|max:191',
        // ]);

        // if($validator->fails()){
        //     return response()->json([
        //         'status' => 422,
        //         'errors' => $validator->messages()
        //     ], 422);
        // } else {

            $registeredUser = RegisteredUser::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'age' => $request->age,
                'email' => $request->email,
                'password' => $request->password,
                'mobile_number' => $request->mobile_number
            ]);

            if($registeredUser) {
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

            
        // }
    }
}
