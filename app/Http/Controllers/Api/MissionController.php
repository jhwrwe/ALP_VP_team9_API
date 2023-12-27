<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Models\Mission;
use App\Http\Requests\StoreMissionRequest;
use App\Http\Requests\UpdateMissionRequest;
use App\Models\TodolistMission;
use Illuminate\Http\Request;
use Exception;
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
        $missionsWithCount = Mission::withCount('todolists')->get();
        foreach ($missionsWithCount as $mission) {
            if ($mission->todolists_count >= $mission->quantity) {

                $mission->update(['status' => true]);
            }
        }

        // Mengembalikan data dalam format yang Anda inginkan menggunakan MissionsResource
        return MissionsResource::collection($missionsWithCount);
    }
}
