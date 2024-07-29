<?php

namespace App\Livewire;

use Livewire\Component;

class LiveToolbar extends Component
{

    public function bold()
    {
        $this->dispatch('bold');
    }
    public function red()
    {
        $this->dispatch('red');
    }

    public function blue()
    {
        $this->dispatch('blue');
    }

    public function green()
    {
        $this->dispatch('green');
    }

    public function white()
    {
        $this->dispatch('white');
    }

    public function back()
    {
        $this->dispatch('back');
    }
    public function forward()
    {
        $this->dispatch('forward');
    }

    public function render()
    {
        return view('livewire.live-toolbar');
    }
}
