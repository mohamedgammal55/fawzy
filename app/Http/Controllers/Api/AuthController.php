<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'user_name' => 'required|exists:users',
            'password' => 'required',
            'type' => 'required|in:customer,owner',
        ]);

        if ($validator->fails()){
            return helperJson(null, $validator->errors(),509);
        }

        $data = $request->only('type', 'user_name','password');

        if (auth()->attempt($data))
        {
            return helperJson(auth()->user(),'done');
        }
        return helperJson(null,'error in data',403);
    }//end fun

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|unique:users',
            'user_name' => 'required|unique:users',
            'national_id' => 'required|unique:users',
            'email' => 'required|unique:users',
            'gender' => 'required|in:male,female',
            'type' => 'required|in:customer,owner',
            'password' => 'required',
        ]);

        if ($validator->fails()){
            return helperJson(null, $validator->errors(),509);
        }

        $data = $request->all();

        $data['password'] = Hash::make($request->password);

        $store = User::create($data);

        return helperJson($store);
    }//end fun
}//end class
