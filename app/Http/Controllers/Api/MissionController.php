<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Models\Mission;
use App\Http\Requests\StoreMissionRequest;
use App\Http\Requests\UpdateMissionRequest;
use App\Models\MissionUser;
use App\Models\TodolistMission;
use App\Models\User;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use PhpParser\Node\Stmt\Catch_;
use App\Http\Resources\MissionsResource;

class MissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function storeMission(Request $request)
    {
        try {
            $validated = $request->validate([
                'title' => 'required|max:255',
                'description' => 'required|string',
                'quantity' => 'required|integer',
                'coins' => 'required|integer',
                'urgency_status' => ''
            ]);

            $mission = Mission::create($validated);
            $users = User::all();

            // Step 3: Attach each user to the created mission
            foreach ($users as $user) {
                MissionUser::create([
                    'user_id' => $user->id,
                    'mission_id' => $mission->id
                ]);  
            }

            return [
                'status' => Response::HTTP_OK,
                'message' => "Success",
                'data' => $mission
            ];
        } catch (Exception $e) {
            return [
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $e->getMessage(),
                'data' => null
            ];
        }
    }

    public function deleteMission($id)
    {
        try {
            $mission = Mission::where('id', $id)->first();

            if (!$mission) {
                return [
                    'status' => Response::HTTP_NOT_FOUND,
                    'message' => "Todolist not found",
                    'data' => null
                ];
            }

            $mission->delete();

            return [
                'status' => Response::HTTP_OK,
                'message' => "Todolist deleted successfully",
                'data' => $mission
            ];

        } catch (Exception $e) {
            return [
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $e->getMessage(),
                'data' => null
            ];
        }
    }

    public function getAllMission()
    {
        $user_id = auth::id();
        $missionsUser = MissionUser::where('user_id', $user_id)->with('mission')->get();

        // Mengembalikan data dalam format yang Anda inginkan menggunakan MissionsResource
        return MissionsResource::collection($missionsUser);
    }

    public function claimMissionCoin($id)
    {   
        $user_id = auth::id();
        $missionsUser = MissionUser::where('user_id', $user_id)->where('mission_id', $id)->first();

        if ($missionsUser->status == false) {
            return [
                'status' => Response::HTTP_NOT_FOUND,
                'message' => "Mission not finish yet",
                'data' => null
            ];
        }
        $user = User::where('id', $user_id)->first();
        $mission = Mission::where('id', $id)->first();
        $user->update([
            $user->coins += $mission->coins
        ]);
        $missionsUser->delete();


        if($missionsUser->status == true){
            
            return [
                'status' => Response::HTTP_OK,
                'message' => "Coin Sucessfully Claimed",
                'data' => null
            ];
        }else{
            return [
                'status' => Response::HTTP_NOT_FOUND,
                'message' => "Mission not found",
                'data' => null
            ];
        }
    }
}
