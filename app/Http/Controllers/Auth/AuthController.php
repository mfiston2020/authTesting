<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    function login(Request $request){
        $this->validate($request,[
            'email'=>'required|email',
            'password'=>'required|min:6'
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user) {
            if (Hash::check($request->password ,$user->password)) {
                $token  =   $user->createToken($user->name)->plainTextToken;
                return response(['user'=>$user,'token'=>$token],200);
            }
            else{
                return response(['message'=>'Invalid Credentials'],403);
            }
        } else {
            return 'user not found';
        }


    }

    function register(Request $request){

        $this->validate($request,[
            'name'=>'required',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|min:6'
        ]);

        $user   =   User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
        ]);

        return response(['message'=>'user Created','user'=>$user],201);

    }

    /**
     * @OA\Get(
     *     path="/api/tokens/users",
     *     @OA\Response(response="200", description="An example endpoint")
     * )
     */
    function getAllUsers(){
        $users  =   User::all();
        return response(['userCount'=>count($users),'user_list'=>$users],200);
    }
}
