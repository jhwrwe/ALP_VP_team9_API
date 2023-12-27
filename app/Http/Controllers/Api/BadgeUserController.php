<?php

namespace App\Http\Controllers;

use App\Models\BadgeUser;

use App\Models\badge;
use App\Http\Resources\BadgeUserResource;
use App\Models\favorite;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BadgeUserController extends Controller
{
    public function ListFavorit(Request $request){
        $user = User::where("id", $request->id)->first();
        $badge = $user->badge()->get();


        return[
            'status'=> Response::HTTP_OK,
            'message'=>'Success',
            'data'=> BadgeUserResource::collection($badge)

        ];

    }
    public function CreateFavorit (Request $request){
        $badgeuser = new BadgeUser();
        $badgeuser->user_id = $request->user_id;
        $badgeuser->badge_id = $request->badge_id;
        $badgeuser->save();
        return[
            'status'=> Response::HTTP_OK,
            'message'=>'Success',
            'data'=> $badgeuser

        ];
    }
    public function DeleteFavorit (Request $request){
        $badgeuser = BadgeUser::where('id', $request->id)->first();
        $badgeuser->delete();
        return[
            'status'=> Response::HTTP_OK,
            'message'=>'deleted',
            'data'=> $badgeuser

        ];
    }
}
