<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;
    
    protected $fillable=['imageable_id' , 'imageable_type' , 'url' , 'img_public_id' , 'path'];

    public function imageable(){
        return $this->morphTo();
    }

}
