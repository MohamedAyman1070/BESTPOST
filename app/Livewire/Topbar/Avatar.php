<?php

namespace App\Livewire\Topbar;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class Avatar extends Component
{
    #[On('render-topbar')]
    public function render()
    {
        return view('livewire.topbar.avatar');
    }
}
