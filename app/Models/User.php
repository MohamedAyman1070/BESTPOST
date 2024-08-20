<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Casts\Attribute ;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'background_color',
        'google_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $with = [
        'photos',
        // 'posts' ,
        //     // 'followers' ,
        //     'reacts',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    // public function followers(){
    //     return $this->belongsToMany(Follower::class);
    // }
    public function reacts()
    {
        return $this->hasMany(React::class);
    }

    public function name():Attribute
    {
        return Attribute::make(
            get: fn(string $name) => ucfirst($name)
        );
    }
    public function photos()
    {
        return $this->morphOne('App\Models\Photo', 'imageable')->latestOfMany();
        // return $this->morphMany('App\Models\Photo','imageable');
    }

    public function isAdmin()
    {
    }
}
