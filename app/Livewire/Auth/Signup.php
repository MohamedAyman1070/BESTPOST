<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Signup extends Component
{
    public $name;
    public $email;
    public $password;
    public $password_confirmation;

    protected $rules = [
        'name' => 'required|min:3|max:15',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6|confirmed',
        'password_confirmation' => 'required|min:6'
    ];

    public function register()
    {
        $data = $this->validate();
        array_splice($data, 3, 3);
        $color = array();

        $color[] = (string)rand(50, 255);
        $color[] = ',' . (string)rand(50, 255);
        $color[] = ',' . (string)rand(50, 255);

        $data['background_color'] = implode($color);

        $email_segment = substr($data['email'], 0, strpos($data['email'], '@'));
        if (strlen($email_segment) > 12) {
            $email_segment = substr($email_segment, 0, 11);
        }
        $rand_arr = [rand(0, 9), rand(0, 9), rand(0, 9)];
        $data['userTag'] = '@' . strtoupper($email_segment) . implode($rand_arr);
        $user = User::create($data);
        Auth::login($user);

        return redirect('/');
    }

    public function render()
    {
        return view('livewire.auth.signup');
    }
}
