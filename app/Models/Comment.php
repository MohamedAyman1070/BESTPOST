<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['body', 'user_id', 'post_id'];


    protected $with= ['reacts' , 'user'] ;


    public function reacts()
    {
        return $this->morphMany('App\Models\React', 'reactable');
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
