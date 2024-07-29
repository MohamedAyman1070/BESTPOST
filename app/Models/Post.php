<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    public $fillable =[
        'body',
        'user_id'
    ];

    public $with= [
        'user',
        'reacts',
        'photos',
    ];
    
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function reacts(){
        return $this->hasMany(React::class);
    }

    public  function photos(){
        return $this->morphMany('App\Models\Photo' , 'imageable');
    }
}
