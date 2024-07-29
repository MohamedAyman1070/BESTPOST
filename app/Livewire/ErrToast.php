<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;

class ErrToast extends Component
{
    public $err;
    

    #[On('show-toast')] 
    public function resetToast($err){
        $this->err = $err;
    }

    public function closeToast(){
        $this->err='';
    }

    public function render()
    {
        return view('livewire.err-toast');
    }
}
