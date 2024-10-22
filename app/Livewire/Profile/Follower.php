<?php

namespace App\Livewire\Profile;

use App\Models\User;
use Livewire\Component;

class Follower extends Component
{
    public $followers;
    public function mount()
    {
        $this->followers = auth()->user()->followers;
    }
    public function render()
    {
        return view('livewire.profile.follower');
    }
}
