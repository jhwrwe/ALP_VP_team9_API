<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BadgeUser extends Model
{
    use HasFactory;

    protected $fillable = [
                'user_id',
                'badge_id',
            ];

            public function badge(){
                return $this->belongsTo(Badge::class);
            }

            public function user(){
                return $this->belongsTo(User::class);
            }
}
