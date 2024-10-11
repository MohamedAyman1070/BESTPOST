<?php

namespace App\Livewire\Auth;

use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class Login extends Component
{
    public $email;
    public $password;

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required|min:6',
    ];

    public function login()
    {
        $attrs = $this->validate();

        try {
            if (!Auth::attempt($attrs)) {
                throw ValidationException::withMessages(['password' => 'Your login credentials dont match an account in our system']);
            }
        } catch (Exception $e) {
            throw ValidationException::withMessages(['password' => $e->getMessage()]);
        }
        session()->regenerate();
        return redirect('/');
    }
    public function render()
    {
        return view('livewire.auth.login');
    }
}
