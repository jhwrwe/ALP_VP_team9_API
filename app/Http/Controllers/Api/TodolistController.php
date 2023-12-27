<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TodolistDetailResource;
use App\Http\Resources\TodolistResource;
use App\Models\Todolist;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Symfony\Component\HttpFoundation\Response;

class TodolistController extends Controller
{
    //berdasarkan urgency
    public function todolist($urgency)
    {
        $todolists = Todolist::where('urgency_status', $urgency)->get();
        return TodolistResource::collection($todolists);
    }

    //todolist detail
    public function todolistDetail($id)
    {
        $todolists = Todolist::where('id', $id)->get();
        return TodolistDetailResource::collection($todolists);
    }
    public function showLateTodolists()
    {
        // Waktu saat ini
        $currentTime = Carbon::now();

        // Ambil todolists yang memiliki tanggal (dan mungkin waktu) lebih kecil dari tanggal saat ini
        $todolists = Todolist::where('date', '<', $currentTime->toDateString())->get();
        return TodolistResource::collection($todolists);
    }

    public function showTodayTodolists()
    {
        // Waktu saat ini
        $currentTime = Carbon::now();

        // Ambil todolists yang memiliki tanggal (dan mungkin waktu) lebih kecil dari tanggal saat ini
        $todolists = Todolist::where('date', $currentTime->toDateString())->get();
        return TodolistResource::collection($todolists);
    }

    public function showTomorrowTodolists()
    {
        // Waktu saat ini
        $currentTime = Carbon::tomorrow();

        // Ambil todolists yang memiliki tanggal (dan mungkin waktu) lebih kecil dari tanggal saat ini
        $todolists = Todolist::where('date', $currentTime->toDateString())->get();
        return TodolistResource::collection($todolists);
    }

    public function showSomedayTodolists()
    {
        // Waktu saat ini
        $currentTime = Carbon::tomorrow();

        // Ambil todolists yang memiliki tanggal (dan mungkin waktu) lebih kecil dari tanggal saat ini
        $todolists = Todolist::where('date', '>', $currentTime->toDateString())->get();
        return TodolistResource::collection($todolists);
    }

    public function showDoneTodolists()
    {

        // Ambil todolists yang memiliki tanggal (dan mungkin waktu) lebih kecil dari tanggal saat ini
        $todolists = Todolist::where('progress_status', 1)->get();
        return TodolistResource::collection($todolists);
    }

    public function storeTodolist(Request $request)
    {
        try {
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

    public function deleteTodolist( $id)
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
