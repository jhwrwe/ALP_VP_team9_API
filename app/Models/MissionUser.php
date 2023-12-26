<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MissionUser extends Model
{
    use HasFactory;

    public function mission(){
        return $this->belongsTo(Mission::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
