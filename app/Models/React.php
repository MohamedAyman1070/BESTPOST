<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class React extends Model
{
    use HasFactory;

    public $fillable = [
        'user_id',
        'post_id',
        'react'
    ];

    public function user (){
        return $this->belongsto(User::class);
    }
    public function post(){
        return $this->belongsto(Post::class);
    }
}
