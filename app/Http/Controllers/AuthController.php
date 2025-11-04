<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\Administrador;
use App\Models\Empleado;
use App\Models\Tecnico;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function showLogin()
        {
            $role = request()->segment(1); // 'admin', 'empleado' o 'soporte'
            $icon = match($role) {
                'admin' => '🛡️',
                'empleado' => '👨‍💼',
                'soporte' => '👨‍🔧',
                default => '🔐',
            };
            return view('auth.login', compact('role', 'icon'));
        }

    public function login(Request $request)
    {
        $roleAttempt = request()->segment(1);

        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $user = Usuario::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'El correo no está registrado.'])->onlyInput('email');
        }

        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => 'Contraseña incorrecta.']);
        }

        $role = $user->role;

        if (!$role) {
            return back()->withErrors(['email' => 'Usuario sin rol asignado.'])->onlyInput('email');
        }

        if ($roleAttempt !== $role) {
            return back()->withErrors(['email' => 'El rol no coincide con este usuario.'])->onlyInput('email');
        }

        Auth::login($user);
        $request->session()->regenerate();

        return match($role) {
            'admin' => redirect()->route('admin.dashboard'),
            'empleado' => redirect()->route('empleado.dashboard'),
            'soporte' => redirect()->route('soporte.dashboard'),
        };
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
            'email' => 'required|email|unique:users,email',
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
            'email.required' => 'El correo es obligatorio.',
            'email.email' => 'El correo no es válido.',
            'email.unique' => 'Este correo ya está registrado.',
            'telefono.max' => 'El teléfono no puede exceder 20 caracteres.',
            'password.required' => 'Por favor ingrese una contraseña.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
        ]);

        $user = Usuario::create([
            'name' => $request->nombre . ' ' . $request->apellidos,
            'nombre' => $request->nombre,
            'apellidos' => $request->apellidos,
            'email' => $request->email,
            'password' => $request->password,
            'telefono' => $request->telefono,
        ]);

        match ($role) {
            'admin' => Administrador::create(['id_usuario' => $user->id]),
            'empleado' => Empleado::create(['id_usuario' => $user->id]),
            'soporte' => Tecnico::create(['id_usuario' => $user->id]),
        };

        return redirect()->route($role . '.login')->with('status', 'Cuenta creada con éxito');
    }
}
