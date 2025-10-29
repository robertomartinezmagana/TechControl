<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function showLogin()
        {
            $role = request()->segment(1); // 'admin', 'empleado' o 'soporte'
            $icon = $role === 'admin' ? '🛡️' : ($role === 'empleado' ? '👨‍💼' : '👨‍🔧');
            return view('auth.login', compact('role', 'icon'));
        }

    public function login(Request $request)
    {
        $role = request()->segment(1); //

        $credentials = $request->validate([
            'usuario' => 'required|email',
            'password' => 'required|string',
        ]);

        // Agregar condición por rol
        $credentials['role'] = $role;

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            // Redirigir según rol
            switch ($role) {
                case 'admin':
                    return redirect()->route('admin.dashboard');
                case 'empleado':
                    return redirect()->route('empleado.dashboard');
                case 'soporte':
                    return redirect()->route('soporte.dashboard');
            }
        }

        return back()->withErrors([
            'usuario' => 'Las credenciales no coinciden o el rol es incorrecto.',
        ])->onlyInput('usuario');
    }

    public function showRegister()
    {
        $role = request()->segment(1);
        $icon = match($role) {
            'admin' => '🛡️',
            'empleado' => '👨‍💼',
            'soporte' => '👨‍🔧',
            default => '🧑',
        };
        return view('auth.register', compact('role', 'icon'));
    }

    public function register(Request $request)
    {
        $role = request()->segment(1);

        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'correo' => 'required|email|unique:users,email',
            'telefono' => 'nullable|string|max:20',
            'password' => [
                'required',
                'confirmed', // usa password_confirmation
                Password::min(10)->max(15)  // longitud 10-15
                    ->letters()              // al menos una letra
                    ->mixedCase()            // al menos minúscula y mayúscula
                    ->numbers()              // al menos un dígito
                    ->symbols()              // al menos un carácter especial
            ],
        ], [
            'nombre.required' => 'Por favor ingrese su nombre.',
            'apellidos.required' => 'Por favor ingrese sus apellidos.',
            'correo.required' => 'El correo es obligatorio.',
            'correo.email' => 'El correo no es válido.',
            'correo.unique' => 'Este correo ya está registrado.',
            'telefono.max' => 'El teléfono no puede exceder 20 caracteres.',
            'password.required' => 'Debes ingresar una contraseña.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
        ]);

        User::create([
            'name' => "{$request->nombre} {$request->apellidos}",
            'email' => $request->correo,
            'password' => Hash::make($request->password),
            'role' => $role
        ]);

        return redirect()->route($role.'.login')
                         ->with('status', 'Cuenta creada con éxito');
    }
}
