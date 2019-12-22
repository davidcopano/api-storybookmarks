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
            'email' => 'email',
            'password' => 'required'
        ]);
        $credentials = $request->only('email', 'password');
        if (auth()->attempt($credentials)) {
            return auth()->user();
        }
        else {
            throw ValidationException::withMessages([
                'user' => ['Credenciales no válidas.']
            ]);
        }
    }
}
