<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TodolistMission extends Model
{
    use HasFactory;
    protected $fillable = [
        'todolist_id',
        'mission_id',
    ];

    public function todolist(){
        return $this->belongsTo(Todolist::class);
    }

    public function mission(){
        return $this->belongsTo(Mission::class);
    }
}
