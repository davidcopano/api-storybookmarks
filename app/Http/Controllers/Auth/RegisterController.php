<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Hash;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:fos_user,email',
            'username' => 'required|unique:fos_user,username',
            'password' => 'required|confirmed|min:6' // confirmed -> "password_confirmation"
        ]);
        $request->merge([
            'username_canonical' => $request->get('username'),
            'email_canonical' => $request->get('email'),
            'enabled' => true,
            'roles' => serialize([]),
            'enable_multimedia' => true,
            'created_at' => now(),
            'updated_at' => now(),
            'password' => Hash::make($request->get('password'))
        ]);
        return User::create($request->all());
    }
}
