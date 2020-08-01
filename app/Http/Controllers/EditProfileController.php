<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class EditProfileController extends Controller
{
    public function __invoke(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'email' => 'required|email'
        ]);
        if($request->filled('password')) {
            $password = $request->get('password');
            $password_confirmation = $request->get('password_confirmation');

            if($password == $password_confirmation) {
                $request->merge([
                    'password' => bcrypt($password)
                ]);
            }
            else {
                throw ValidationException::withMessages([
                    'password' => 'Las contraseñas no coinciden'
                ]);
            }
        }
        $request->merge([
            'username_canonical' => $request->get('username'),
            'email_canonical' => $request->get('email')
        ]);
        $params = $request->only(['username', 'username_canonical', 'email', 'email_canonical',  'password']);
        auth()->user()->update($params);

        return response()->json(auth()->user());
    }
}
