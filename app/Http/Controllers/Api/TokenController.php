<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class TokenController extends Controller
{
    public function crear(Request $request)
    {
        $datos = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
            'dispositivo' => ['required'],
        ]);

        $usuario = \App\Models\User::where('email', $datos['email'])->first();

        if (! $usuario || ! Hash::check($datos['password'], $usuario->password)) {
            throw ValidationException::withMessages([
                'email' => 'Esas credenciales no coinciden con nuestros registros.',
            ]);
        }

        return [
            'token' => $usuario->createToken($datos['dispositivo'])->plainTextToken,
            'usuario' => $usuario->name,
            'rol' => $usuario->rol,
        ];
    }

    public function revocar(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return ['mensaje' => 'Token revocado'];
    }
}