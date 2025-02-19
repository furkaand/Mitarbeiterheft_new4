<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('dashboard')->with('success', 'Anmeldung erfolgreich');
        }

        return back()->withErrors([
            'email' => 'Die Anmeldeinformationen stimmen nicht überein',
        ])->onlyInput('email');
    }

    public function create(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'firstname' => ['required'],
            'lastname' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required'],
            'password_confirmation' => ['required', 'same:password'],
        ]);

        User::create([
            'firstname' => $credentials['firstname'],
            'lastname' => $credentials['lastname'],
            'email' => $credentials['email'],
            'password' => bcrypt($credentials['password']),
        ]);

        return redirect()->intended('login')->with('success', 'Benutzerkonto erfolgreich erstellt');
    }
}
