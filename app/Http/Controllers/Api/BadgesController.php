<?php

namespace App\Http\Controllers\Api;

use App\Models\badge;
use App\Http\Controllers\Controller;
use App\Http\Resources\BadgeResource;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Stmt\Catch_;
use Symfony\Component\HttpFoundation\Response;
class BadgesController extends Controller
{
    public function createBadge(Request $request){
        try{
        $badge = new badge();
        $badge->name = $request->name;
        $badge->image = $request->image;
        $badge->price = $request->price;
        $badge->save();

        return[
            'status'=> Response::HTTP_OK,
            'message'=> "Success",
            'data'=>$badge
        ];
    } Catch(Exception $e){
        return [
            'status'=> Response::HTTP_INTERNAL_SERVER_ERROR,
            'message'=> $e->getMessage(),
            'data'=> $badge
            ];
        }
}
public function updateBadge(Request $request){
    $badge = badge::where('id',$request->id)->first();

        if(!empty($badge)){
           try{
            $badge->image = $request->image;
            $badge->name = $request->name;
            $badge->price = $request->price;
            $badge->save();

            return [
            'status'=> Response::HTTP_OK,
            'message'=> 'Success',
            'data'=>$badge
            ];
           }catch(Exception $e){
            return [
                'status'=> Response::HTTP_INTERNAL_SERVER_ERROR,
                'message'=> $e->getMessage(),
                'data'=> $badge
                ];
           }
        }
        return[
            'status'=> Response::HTTP_NOT_FOUND,
            'message'=> 'Badge not found',
            'data'=> []
        ];
    }
    public function deletedbadge(Request $request)
{
    $badge = badge::where('id', $request->id)->first();
    if (!empty($badge)) {
        try {
            $badge->delete();
            return [
                'status' => Response::HTTP_OK,
                'message' => 'Success',
                'data' => $badge
            ];
        } catch (Exception $e) {
            return [
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $e->getMessage(),
                'data' => $badge
            ];
        }
    } else {
        return [
            'status' => Response::HTTP_NOT_FOUND,
            'message' => 'Badge not found',
            'data' => []
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
