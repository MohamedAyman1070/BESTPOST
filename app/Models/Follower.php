<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follower extends Model
{
    use HasFactory;
    public $table = 'followers';

    public $fillable = [
        'follower',
        'user'
    ];

    public function user (){
        return $this->belongsToMany(User::class);
    }

    public static function getUserFollowers(User $user){
        return self::all()->where('user_id' , $user->id);
    }

    public static function getFollowing(User $user){
        return self::all()->where('follower' ,$user->id);
    }

  

}
