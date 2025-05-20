<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\ValidationException;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;


class AuthController extends Controller
{
    public function login(Request $request)
    {
        // 1) Valida los campos que realmente vienen del front
        $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            throw ValidationException::withMessages([
                'email' => ['El usuario no existe.'],
            ]);
        }

        // 2) Prepara TODO lo que Passport necesita
        $payload = [
            'grant_type'    => 'password',
            'client_id'     => config('services.passport.password_client_id'),
            'client_secret' => config('services.passport.password_client_secret'),
            'username'      => $request->email,
            'password'      => $request->password,
            'scope'         => '',
        ];

        // 3) Crea la sub-petición interna
        $tokenRequest = Request::create('/oauth/token', 'POST', $payload);

        // 4) Ejecuta la sub-petición y guarda la respuesta
        $response = app()->handle($tokenRequest);

        // 5) Decodifica la respuesta de Passport
        $data = json_decode((string) $response->getContent(), true);

        // 6) Añade el usuario a los datos
        $data['user'] = $user;

        // 7) Devuelve todo en JSON con el mismo código de estado
        return response()->json($data, $response->getStatusCode());
    }

    /**
     * Registra un nuevo usuario.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function register(Request $request)
    {

        $data = $request->validate([
            'name'                  => 'required|string|max:255',
            'email'                 => 'required|email|unique:users,email',
            'password'              => 'required|min:8',
            'role_id'               => 'required|exists:roles,id',
            'tutor_id'              => ['nullable', 'exists:users,id'],
        ]);

        // Asignar tutor automáticamente si es alumno (role_id = 2)
        if ($data['role_id'] == 2) {
            $admin = User::where('role_id', 1)->first();
            $data['tutor_id'] = $admin ? $admin->id : null;
        } else {
            // Si no es alumno, no puede tener tutor
            $data['tutor_id'] = null;
        }

        $data['password'] = Hash::make($data['password']);
        
        $user = User::create($data);

        return response()->json([
            'message' => 'Usuario registrado con éxito',
            'user'    => $user,
        ], 201);
    }


    public function logout(Request $request)
    {
        $user = $request->user();
        $user->tokens()->delete();

        return response()->json(['message' => 'Logout exitoso'], 200);
    }
}
