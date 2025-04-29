<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

       $user = User::where('email', $request->email)->firstOrFile();

        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        if (!Hash::check($request->password, $user->password)) {
            return UserResource::make($user);
        }else {
            return response()->json(['error' => 'Credenciales incorrectas'], 401);
        }
    }
}
