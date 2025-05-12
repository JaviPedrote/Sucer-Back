<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    // GET /api/v1/roles
    public function index()
    {
        return response()->json(Role::all(), 200);
    }

    // POST /api/v1/roles
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|unique:roles,name',
            'slug' => 'nullable|string|unique:roles,slug',
        ]);

        $role = Role::create($data);

        return response()->json($role, 201);
    }

    // GET /api/v1/roles/{role}
    public function show(Role $role)
    {
        return response()->json($role, 200);
    }

    // PUT /api/v1/roles/{role}
    public function update(Request $request, Role $role)
    {
        $data = $request->validate([
            'name' => 'required|string|unique:roles,name,' . $role->id,
            'slug' => 'nullable|string|unique:roles,slug,' . $role->id,
        ]);

        $role->update($data);

        return response()->json($role, 200);
    }

    // DELETE /api/v1/roles/{role}
    public function destroy(Role $role)
    {
        $role->delete();
        return response()->json(null, 204);
    }
}
