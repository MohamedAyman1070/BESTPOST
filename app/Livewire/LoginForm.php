<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class LoginForm extends Component
{
    public $email ;
    public $password;

    protected $rules = [
        'email' =>'required|email',
        'password' =>'required|min:6',
    ];
    
    public function login(){
        $attrs = $this->validate();

        if( !Auth::attempt($attrs) ){
            throw ValidationException::withMessages(['password' => 'Your login credentials dont match an account in our system']);
        }
        session()->regenerate();
        return redirect('/');
    }
    public function render()
    {
        return view('livewire.login-form');
    }
}
