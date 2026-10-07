<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

/**
 * Gestiona el inicio y cierre de sesión del área de administración.
 */
class AuthController extends Controller
{
    /**
     * Muestra el formulario de inicio de sesión.
     */
    public function loginForm(): View
    {
        return view('admin.login');
    }

    /**
     * Valida las credenciales e inicia la sesión del usuario.
     */
    public function loginProcess(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email', 'max:255'],
            'password' => ['required', 'string'],
        ], [
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'Ingresa una dirección de correo electrónico válida.',
            'email.max' => 'El correo electrónico no puede superar los :max caracteres.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.string' => 'La contraseña debe ser texto.',
        ]);

        if (! Auth::attempt($credentials)) {
            return redirect()
                ->route('admin.login')
                ->withInput($request->only('email'))
                ->withErrors(['email' => 'Las credenciales ingresadas no son válidas.']);
        }

        $request->session()->regenerate();

        return redirect()
            ->route('admin.dashboard')
            ->with('success', '¡Bienvenido de vuelta!');
    }

    /**
     * Cierra la sesión y redirige al formulario con una confirmación visible.
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('admin.login')
            ->with('success', 'Has cerrado tu sesión correctamente.');
    }
}
