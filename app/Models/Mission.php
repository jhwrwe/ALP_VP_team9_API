<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mission extends Model
{
    use HasFactory;


    protected $fillable = [
        'title',
        'description',
        'quantity',
        'urgency_status',
        'description',
        'progress_status',
        'location'
    ];

    public function todolists()
    {
        return $this->belongsToMany(Todolist::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
