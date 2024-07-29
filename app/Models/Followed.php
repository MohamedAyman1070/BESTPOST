<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Followed extends Model
{
    use HasFactory;
    public $table= 'following';

    public $fillable=[
        'followed',
        'user'
    ];

   

}
