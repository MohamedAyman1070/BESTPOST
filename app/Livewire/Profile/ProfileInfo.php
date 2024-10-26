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
    public $userTag;
    public $created_at;
    public  $background_color;
    public $postsCount;
    public $followersCount;
    public $followingCount;
    public $reactCount;
    public $user;

    public function mount()
    {
        $this->user = User::where('userTag', $this->userTag)->first();
        $reacts = React::whereBelongsTo($this->user)->get();
        $this->reactCount = count($reacts);

        $posts = Post::whereBelongsTo($this->user)->get();
        $this->postsCount = count($posts);

        $this->followersCount = $this->user->followers->count();

        $this->followingCount = $this->user->following->count();


        $this->username = $this->user->name;
        $this->email = $this->user->email;
        $this->userTag = $this->user->userTag;
        $this->created_at = $this->user->created_at;
        $this->background_color = $this->user->background_color;
    }
    public function render()
    {
        return view('livewire.profile.profile-info');
    }
}
