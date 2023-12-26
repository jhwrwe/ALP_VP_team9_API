<?php

namespace App\Http\Controllers;

use App\Models\badge;
use App\Http\Controllers\Controller;
use App\Http\Resources\BadgeResource;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Stmt\Catch_;
use Symfony\Component\HttpFoundation\Response;

class BadgeController extends Controller
{

    public function getAllUser(){
        $users = badge::all();
        return BadgeResource::collection($users);
    }
    public function checkPassword(){
        $users = badge::all();
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
        $user = new badge();
        $user->name = $request->name;
        $user->image = $request->image;
        $user->price = $request->price;
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
        $user = badge::where('id',$request->id)->first();

        if(!empty($user)){
           try{
            $user->image = $request->image;
            $user->name = $request->name;
            $user->price = $request->price;
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
            'message'=> 'Badge not found',
            'data'=> []
        ];
    }
    public function deleteUser(Request $request)
    {
     $user = badge::where('id', $request->id)->first();
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
}
