<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    public function login(Request $request){
        $email = $request->get('email');
        $password = $request->get('password');
        if(Auth::attempt(compact('email','password'))){
            /** @var \App\Models\MyUserModel $user **/
            $user=Auth::user();
            $access_token= $user->createToken("authToken")->plainTextToken;
            return response()->json([
                'status'=>true,
                'message'=>"user authenticated successfully",
                'token'=>$access_token
            ]);
        }else{
            return response()->json([
                'status'=>false,
                'message'=>"Invalid username or password"
            ]);
        }
   
    }


    public function register(Request $request)
    {
        $user =new User();
        $user->name=$request->get('name');
        $user->phone=$request->get('phone');
        $user->email=$request->get('email');
        $user->password=bcrypt($request->get('password'));
        $user->isAdmin = $request->get('isAdmin');
        $user->save();

        $access_token= $user->createToken("authToken")->plainTextToken;

        return response()->json([
            'status'=>true,
            'message'=>"user Registered successfully",
            'token'=>$access_token
        ]);
    }
}
