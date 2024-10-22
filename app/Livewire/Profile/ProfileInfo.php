<?php

namespace App\Livewire\Profile;

use App\Models\Follower;
use App\Models\Post;
use App\Models\React;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ProfileInfo extends Component
{
    public $username;
    public $email;
    public $created_at;
    public  $background_color;
    public $postsCount;
    public $followersCount;
    public $followingCount;
    public $reactCount;

    public function mount()
    {

        $reacts = React::whereBelongsTo(Auth::user())->get();
        $this->reactCount = count($reacts);

        $posts = Post::whereBelongsTo(Auth::user())->get();
        $this->postsCount = count($posts);

        $this->followersCount = auth()->user()->followers->count();

        $this->followingCount = auth()->user()->following->count();


        $this->username = Auth::user()->name;
        $this->email = Auth::user()->email;
        $this->created_at = Auth::user()->created_at;
        $this->background_color = Auth::user()->background_color;
    }
    public function render()
    {
        return view('livewire.profile.profile-info');
    }
}
