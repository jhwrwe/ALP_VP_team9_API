<?php

namespace App\Http\Controllers;

use App\Models\Mission;
use App\Http\Requests\StoreMissionRequest;
use App\Http\Requests\UpdateMissionRequest;
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
    public function CreateMission(Request $request)
    {
        try {
            $validated = $request->validate([
                'title' => 'required|max:255',
                'description' => 'required|string',
                'quantity' => 'required|integer',
                'coins' => 'required|integer',
            ]);

            $Mission = Mission::create($validated);
            return [
                'status' => Response::HTTP_OK,
                'message' => "Success",
                'data' => $Mission
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
            $Mission =  Mission::where('id', $id)->first();

            if (!$Mission) {
                return [
                    'status' => Response::HTTP_NOT_FOUND,
                    'message' => "Todolist not found",
                    'data' => null
                ];
            }

            $Mission->delete();

            return [
                'status' => Response::HTTP_OK,
                'message' => "Todolist deleted successfully",
                'data' => $Mission
            ];

        } catch (Exception $e) {
            return [
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $e->getMessage(),
                'data' => null
            ];
        }
    }
    public function getAllMission(){
        $Mission = Mission::all();
        return MissionsResource::collection($Mission);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMissionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Mission $mission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mission $mission)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMissionRequest $request, Mission $mission)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mission $mission)
    {
        //
    }
}
