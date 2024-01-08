<?php

namespace App\Http\Controllers\Admision;

use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admision.auth');
    }

    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'usuario' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();
            return redirect()->intended('home');
            /* if ($user->hasRole('admin')) {
                return redirect()->intended('home');
            } elseif ($user->hasRole('modify')) {
                return redirect()->intended('modificar-postulante');
            } elseif ($user->hasRole('validatePhotos')) {
                return redirect()->intended('home');
            } elseif ($user->roles()->count() == 0) {
                return redirect()->intended('/restringido');
            } else {
                return redirect()->intended('/');
            } */
        }

        return back()->withErrors([
            'usuario' => 'Credenciales incorrectas',

        ])->onlyInput();
    }



    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
