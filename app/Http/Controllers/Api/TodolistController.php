<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TodolistDetailResource;
use App\Http\Resources\TodolistResource;
use App\Models\Mission;
use App\Models\MissionUser;
use App\Models\Todolist;
use App\Models\TodolistMission;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class TodolistController extends Controller
{
    //berdasarkan urgency
    public function todolist($urgency)
    {
        $userId = Auth::id();
        $todolists = Todolist::where('urgency_status', $urgency)->where('user_id', $userId)->get();
        return TodolistResource::collection($todolists);
    }

    public function allTodolist()
    {
        $userId = Auth::id();
        $todolists = Todolist::all()->where('user_id', $userId);
        return TodolistResource::collection($todolists);
    }

    //todolist detail
    public function todolistDetail($id)
    {
        $userId = Auth::id();
        $todolists = Todolist::where('id', $id)->where('user_id', $userId)->get();
        return TodolistDetailResource::collection($todolists);
    }
    public function showLateTodolists()
    {
        $userId = Auth::id();
        $currentTime = Carbon::now();

        // Ambil todolists yang memiliki tanggal (dan mungkin waktu) lebih kecil dari tanggal saat ini
        $todolists = Todolist::where('date', '<', $currentTime->toDateString())->where('user_id', $userId)->get();
        return TodolistResource::collection($todolists);
    }

    public function showTodayTodolists()
    {
        $userId = Auth::id();
        $currentTime = Carbon::now();

        // Ambil todolists yang memiliki tanggal (dan mungkin waktu) lebih kecil dari tanggal saat ini
        $todolists = Todolist::where('date', $currentTime->toDateString())->where('user_id', $userId)->get();
        return TodolistResource::collection($todolists);
    }

    public function showTomorrowTodolists()
    {
        $userId = Auth::id();
        $currentTime = Carbon::tomorrow();

        // Ambil todolists yang memiliki tanggal (dan mungkin waktu) lebih kecil dari tanggal saat ini
        $todolists = Todolist::where('date', $currentTime->toDateString())->where('user_id', $userId)->get();
        return TodolistResource::collection($todolists);
    }

    public function showSomedayTodolists()
    {
        $userId = Auth::id();
        $currentTime = Carbon::tomorrow();

        // Ambil todolists yang memiliki tanggal (dan mungkin waktu) lebih kecil dari tanggal saat ini
        $todolists = Todolist::where('date', '>', $currentTime->toDateString())->where('user_id', $userId)->get();
        return TodolistResource::collection($todolists);
    }

    public function showDoneTodolists()
    {

        $userId = Auth::id();
        $todolists = Todolist::where('progress_status', 1)->where('user_id', $userId)->get();
        return TodolistResource::collection($todolists);
    }

    public function todolistDone($id)
    {
        try {
            $user_id = Auth::id();
            $todolist = Todolist::where('id', $id)->first();

            if (!$todolist) {
                return [
                    'status' => Response::HTTP_NOT_FOUND,
                    'message' => "Todolist not found",
                    'data' => null
                ];
            }

            if ($todolist->user_id != $user_id) {
                return [
                    'status' => Response::HTTP_NOT_FOUND,
                    'message' => "Not your todolist",
                    'data' => null
                ];
            }

            $todolist->update([
                $todolist->progress_status = true
            ]);

            $urgencyStatus = $todolist->urgency_status;

            $missions = Mission::where(function ($query) use ($urgencyStatus) {
                $query->where('urgency_status', $urgencyStatus)
                    ->orWhereNull('urgency_status');
            })
                ->get();

            foreach ($missions as $mission) {
                TodolistMission::create([
                    'todolist_id' => $todolist->id,
                    'mission_id' => $mission->id
                ]);
            }


            $missionsWithCount = Mission::select('missions.*')
                ->withCount(['todolists' => function ($query) use ($user_id) {
                    $query->where('user_id', $user_id);
                }])
                ->whereHas('todolists', function ($query) use ($user_id) {
                    $query->where('user_id', $user_id);
                })
                ->get();

            foreach ($missionsWithCount as $mission) {
                $userMission = MissionUser::where('user_id', $user_id)
                        ->where('mission_id', $mission->id)
                        ->first();
                if($userMission->status != true){
                    $userMission->update(['remaining' => $mission->todolists_count]);
                }
                
                if ($mission->todolists_count >= $mission->quantity) {
                    $userMission->update(['status' => true]);
                }
            }
            dd($missionsWithCount);

            return [
                'status' => Response::HTTP_OK,
                'message' => "Success",
                'data' => $todolist
            ];
        } catch (Exception $e) {
            return [
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $e->getMessage(),
                'data' => null
            ];
        }

    }

    public function storeTodolist(Request $request)
    {
        try {
            $request['user_id'] = Auth::user()->id;
            $validated = $request->validate([
                'title' => 'required|max:255',
                'date' => 'required',
                'time' => 'required',
                'urgency_status' => 'required',
                'description' => 'required',
                'progress_status' => 'required',
                'location' => 'required',
                'user_id' => 'required|exists:users,id'
            ]);

            $todolist = Todolist::create($validated);
            return [
                'status' => Response::HTTP_OK,
                'message' => "Success",
                'data' => $todolist
            ];
        } catch (Exception $e) {
            return [
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $e->getMessage(),
                'data' => null
            ];
        }
    }

    public function updateTodolist(Request $request, $id)
    {
        try {
            // Validasi input
            $validated = $request->validate([
                'title' => 'required|max:255',
                'date' => 'required',
                'time' => 'required',
                'urgency_status' => 'required',
                'description' => 'required',
                'progress_status' => 'required',
                'location' => 'required',
                'user_id' => 'required',
            ]);

            $todolist = Todolist::where('id', $id)->first();

            if (!$todolist) {
                return [
                    'status' => Response::HTTP_NOT_FOUND,
                    'message' => "Todolist not found",
                    'data' => null
                ];
            }

            $todolist->update($validated);

            return [
                'status' => Response::HTTP_OK,
                'message' => "Todolist updated successfully",
                'data' => $todolist
            ];

        } catch (Exception $e) {
            return [
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $e->getMessage(),
                'data' => null
            ];
        }
    }

    public function deleteTodolist($id)
    {
        try {
            $todolist = Todolist::where('id', $id)->first();

            if (!$todolist) {
                return [
                    'status' => Response::HTTP_NOT_FOUND,
                    'message' => "Todolist not found",
                    'data' => null
                ];
            }

            $todolist->delete();

            return [
                'status' => Response::HTTP_OK,
                'message' => "Todolist deleted successfully",
                'data' => $todolist
            ];

        } catch (Exception $e) {
            return [
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $e->getMessage(),
                'data' => null
            ];
        }
    }




}
