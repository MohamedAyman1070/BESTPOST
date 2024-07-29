<?php

namespace App\Livewire\Profile;

use App\Models\Post as ModelsPost;
use Livewire\Component;

class Post extends Component
{

    public $posts ;


    public function mount(){
        $this->posts = ModelsPost::where('user_id'  ,auth()->user()->id)->latest()->get();
    }

    public function oldest(){
        $this->posts = ModelsPost::where('user_id'  ,auth()->user()->id)->get();
    }
    public function latest(){
        $this->posts = ModelsPost::where('user_id'  ,auth()->user()->id)->latest()->get();
    }
    public function popular(){

    }

    public function render()
    {
        return view('livewire.profile.post');
    }
}
