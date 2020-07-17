<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
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
            auth()->user()->update([
                'last_login' => now()
            ]);
            $user = auth()->user()->toArray();
            $user['api_token'] = $api_token;
            return $user;
        } else {
            throw ValidationException::withMessages([
                'user' => ['Credenciales no válidas.']
            ]);
        }
    }

    public function socialLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'username' => 'required'
        ]);
        $user = User::where('email', $request->get('email'))->first();
        if (!$user) {
            $user = User::create([
                'username' => $request->get('username'),
                'username_canonical' => $request->get('username'),
                'email' => $request->get('email'),
                'email_canonical' => $request->get('email'),
                'enabled' => true,
                'password' => Hash::make(Str::random(10)),
                'roles' => serialize([]),
                'created_at' => now(),
                'enable_multimedia' => true
            ]);
        }
        auth()->loginUsingId($user->id);
        $api_token = auth()->user()->createToken('storybookmarks')->accessToken;
        auth()->user()->update([
            'last_login' => now()
        ]);
        $user = auth()->user()->toArray();
        $user['api_token'] = $api_token;
        return $user;
    }
}
