<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TodolistDetailResource;
use App\Http\Resources\TodolistResource;
use App\Models\Todolist;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class TodolistController extends Controller
{
    //berdasarkan urgency
    public function todolist($urgency){
        $todolists = Todolist::where('urgency_status', $urgency)->get();
        return TodolistResource::collection($todolists);
    }

    //todolist detail
    public function todolistDetail($id){
        $todolists = Todolist::where('id', $id)->get();
        return TodolistDetailResource::collection($todolists);
    }
    public function showLateTodolists(){
        // Waktu saat ini
        $currentTime = Carbon::now();

        // Ambil todolists yang memiliki tanggal (dan mungkin waktu) lebih kecil dari tanggal saat ini
        $todolists = Todolist::where('date', '<', $currentTime->toDateString())->get();
        return TodolistResource::collection($todolists);
    }

    public function showTodayTodolists(){
        // Waktu saat ini
        $currentTime = Carbon::now();

        // Ambil todolists yang memiliki tanggal (dan mungkin waktu) lebih kecil dari tanggal saat ini
        $todolists = Todolist::where('date', $currentTime->toDateString())->get();
        return TodolistResource::collection($todolists);
    }

    public function showTomorrowTodolists(){
        // Waktu saat ini
        $currentTime = Carbon::tomorrow();

        // Ambil todolists yang memiliki tanggal (dan mungkin waktu) lebih kecil dari tanggal saat ini
        $todolists = Todolist::where('date', $currentTime->toDateString())->get();
        return TodolistResource::collection($todolists);
    }

    public function showSomedayTodolists(){
        // Waktu saat ini
        $currentTime = Carbon::tomorrow();

        // Ambil todolists yang memiliki tanggal (dan mungkin waktu) lebih kecil dari tanggal saat ini
        $todolists = Todolist::where('date', '>', $currentTime->toDateString())->get();
        return TodolistResource::collection($todolists);
    }

    
}
