<?php
namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\ValidationException;
use App\Http\Controllers\Controller;
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

        // 2) Prepara TODO lo que Passport necesita
        $payload = [
            'grant_type'    => 'password',
            'client_id'     => config('services.passport.password_client_id'),
            'client_secret' => config('services.passport.password_client_secret'),
            'username'      => $request->email,
            'password'      => $request->password,
            'scope'         => '',
        ];

        // 3) Crea la sub-petición interna *con el payload como 3er parámetro*
        $tokenRequest  = Request::create('/oauth/token', 'POST', $payload);

        // 4) Envíala por el kernel y devuelve la respuesta tal cual
        return app()->handle($tokenRequest);
    }
}
