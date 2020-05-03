<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:fos_user,email',
            'username' => 'required|unique:fos_user,username',
            'password' => 'required|confirmed|min:6'
        ]);
    }
}
