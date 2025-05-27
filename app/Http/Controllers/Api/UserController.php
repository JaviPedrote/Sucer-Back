<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $user = Auth::guard('api')->user();


        // Return the users as a JSON response
        $users = User::with('role')
            // Si NO es admin (rol distinto a 1), filtramos por user_id
            ->when(
                $user->role_id !== 1,
                fn($query) => $query->where('id', $user->id)
            )
            ->orderBy('role_id', 'asc')
            ->included()
            ->fitter()
            ->sort()
            ->getOrPaginate();

        return response()->json($users);
    }

    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $user = User::with('role')->findOrFail($user->id);
        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8',
        ]);

        // Update the user
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role_id' => $request->role_id,
            'tutor_id' => $request->tutor_id,
            'password' => $request->password ? bcrypt($request->password) : $user->password,
        ]);


        return response()->json($user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        // Check if the user exists
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
        // Delete the user
        $user->delete();

        // Return a success response
        return response()->json(['message' => $user->email . ' deleted successfully']);
    }
}
