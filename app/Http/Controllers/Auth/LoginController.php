<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function validateLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $credentials = $request->only('email', 'password');
        if (auth()->attempt($credentials)) {
            $api_token = auth()->user()->createToken('storybookmarks')->accessToken;
            $user = auth()->user()->toArray();
            $user['api_token'] = $api_token;
            return $user;
        }
        else {
            throw ValidationException::withMessages([
                'user' => ['Credenciales no válidas.']
            ]);
        }
    }
}
