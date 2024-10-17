<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callbackGoogle()
    {
        try {
            $google_user =  Socialite::driver('google')->user();
            $user = User::where('google_id', $google_user->getId())->first();
            if (!$user) {

                $color = array();

                $color[] = (string)rand(50, 255);
                $color[] = ',' . (string)rand(50, 255);
                $color[] = ',' . (string)rand(50, 255);

                $newUser = User::create([
                    'google_id' => $google_user->getId(),
                    'name' => $google_user->getName(),
                    'email' => $google_user->getEmail(),
                    'background_color' => implode($color),
                ]);

                Auth::login($newUser);
                return redirect('/');
            }
            Auth::login($user);
            return redirect('/');
        } catch (Exception $e) {
            dd('ERR : ', $e->getMessage());
        }
    }
}
