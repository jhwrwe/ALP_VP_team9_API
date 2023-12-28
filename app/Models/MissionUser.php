<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MissionUser extends Model
{
    use HasFactory;
    protected $fillable = [
        'mission_id',
        'user_id',
        'status',
        'remaining'
    ];

    public function mission(){
        return $this->belongsTo(Mission::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
