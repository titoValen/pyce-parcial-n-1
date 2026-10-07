<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginForm()
    {
        return view('admin.login');
    }

    public function loginProcess(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            return redirect()
                ->route('admin.login')
                ->withInput($request->only('email'))
                ->with('error', 'Credenciales inválidas.');
        }

        return redirect()
            ->route('admin.dashboard')
            ->with('success', '¡Bienvenido de vuelta!');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return view('admin.logout');
    }
}
