<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Mission;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Stmt\Catch_;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function getAllUser(){
        $users = User::all();
        return UserResource::collection($users);
    }
    public function checkPassword(){
        $users = User::all();
        $check =[];

        foreach($users as $user){
            array_push($check,
            Hash::check($user->username, $user->password)
        );
        }
        return $check;
    }


    public function createUser(Request $request){
        try{
        $user = new User();
        $user->fullname = $request->fullname;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->phone_number = $request->phone_number;
        $user->username = $request->username;
        $user->save();

        return[
            'status'=> Response::HTTP_OK,
            'message'=> "Success",
            'data'=>$user
        ];
    } Catch(Exception $e){
        return [
            'status'=> Response::HTTP_INTERNAL_SERVER_ERROR,
            'message'=> $e->getMessage(),
            'data'=> $user
            ];
        }
}
public function updateUser(Request $request){
    if(!empty($request->email)){
    $user = User::where('email',$request->email)->first();
        }else{
            $user = User::where('id',$request->id)->first();
        }
        if(!empty($user)){
           try{
            $user->fullname = $request->fullname;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->phone_number = $request->phone_number;
            $user->username = $request->username;
            $user->save();
            return [
            'status'=> Response::HTTP_OK,
            'message'=> 'Success',
            'data'=>$user
            ];
           }catch(Exception $e){
            return [
                'status'=> Response::HTTP_INTERNAL_SERVER_ERROR,
                'message'=> $e->getMessage(),
                'data'=> $user
                ];
           }
        }
        return[
            'status'=> Response::HTTP_NOT_FOUND,
            'message'=> 'User not found',
            'data'=> []
        ];
    }
    public function deleteUser(Request $request)
    {
        if (!empty($request->id)) {
            $user = User::where('id', $request->id)->first();
        } else {
            $user = User::where('email', $request->email)->first();
        }
        if (!empty($user)) {
            try {
                $user->delete();
                return [
                    'status' => Response::HTTP_OK,
                    'message' => 'Success',
                    'data' => $user
                ];
            } catch (Exception $e) {
                return [
                    'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
                    'message' => $e->getMessage(),
                    'data' => $user
                ];
            }
        } else {
            return [
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => 'USER NOT FOUND',
                'data' => $user
            ];
        }
    }
    public function UploadImage(Request $request){
        if($request->hasFile('image')){
            $image = $request->file('image');
            if($image->isValid()){
                    $image->resize(0,0);
                    $image->save();
                    return [
                        'status'=> Response::HTTP_OK,
                        'message'=> ''
                        ];
                                    }
        }
    }
    // public function addCoins($id){
    //     $validated =
    //     $user = User::where('id', Auth::id())->first();
    //     $->update($validated);
    // }
}
