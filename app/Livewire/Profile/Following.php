<?php

namespace App\Livewire\Profile;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class Following extends Component
{
    public $following;
    public function mount()
    {
        $this->following = auth()->user()->following;
    }
    public function unfollow(User $following_user)
    {
        $user = User::find(Auth::user())->first();
        $user->following()->detach($following_user->id);
        $this->following = auth()->user()->following;
    }
    public function render()
    {
        return view('livewire.profile.following');
    }
}
