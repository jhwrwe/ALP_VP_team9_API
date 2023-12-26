<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TodolistDetailResource;
use App\Http\Resources\TodolistResource;
use App\Models\Todolist;
use Illuminate\Http\Request;

class TodolistController extends Controller
{
    public function todolist($urgency){
        $todolists = Todolist::where('urgency_status', $urgency)->get();
        return TodolistResource::collection($todolists);
    }

    public function todolistDetail($id){
        $todolists = Todolist::where('id', $id)->get();
        return TodolistDetailResource::collection($todolists);
    }
}
