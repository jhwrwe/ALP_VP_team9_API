<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Models\User;
use Hash;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function login(Request $request){
        $request->validate([
            "username"=> "required",
            "password"=> "required"
        ]);
        $user = User::where("username", $request->username)->first();
        if(!empty($user)){
            if(Hash::check($request->password, $user->password)){
                return [
                    "status"=> Response::HTTP_OK,
                    "message"=> "Token Created",
                    'data'=>$user->createToken('login')->plainTextToken,
                ];
            }else{
                return [
                    "status"=> Response::HTTP_FORBIDDEN,
                    "message"=> "Incorrect Password",
                    'data'=>[],
                ];
            }
        }{
            return [
                "status"=> Response::HTTP_NOT_FOUND,
                "message"=> "User not found",
                'data'=>[],
            ];
        }
    }
    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();
        return [
            'status'=> Response::HTTP_OK,
            'message'=> 'Token Deleted',
            'data'=>[]
        ];
    }
}
