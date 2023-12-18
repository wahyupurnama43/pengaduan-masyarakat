<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {

        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function store(RegisterRequest $registerRequest)
    {
        $email = $registerRequest->email;
        $password = $registerRequest->password;
        $nama = $registerRequest->nama;

        $user = new User();
        $user->email = $email;
        $user->nama = $nama;
        $user->password = Hash::make($password);
        $user->save();

        auth()->login($user);

        return to_route('dashboard')->with('success', 'congratulations you successfully Login');
    }

    public function loginStore(LoginRequest $loginRequest)
    {
        $email = $loginRequest->email;
        $password = $loginRequest->password;

        $user = User::where('email', $email)->first();

        if ($user) {

            if (!Hash::check($password, $user->password)) {
                return redirect()->back()->withErrors(['error' => 'incorrect password']);
            }
            auth()->login($user);

            return to_route('dashboard')->with('success', 'congratulations you successfully registered');
        } else {
            return to_route('auth.login')->with('error', 'Email or password incorrect');
        }

    }
}
