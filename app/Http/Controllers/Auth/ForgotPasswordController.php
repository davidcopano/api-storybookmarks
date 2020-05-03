<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    public function reset(Request $request)
    {
        $request->validate([
            'email' => 'required|exists:fos_user,email|email'
        ]);
        Password::sendResetLink(['email' => $request->get('email')], function (Message $message) {
            $message->subject($this->getEmailSubject());
        });
        return response()->json(['message' => 'Email sent']);
    }
}
