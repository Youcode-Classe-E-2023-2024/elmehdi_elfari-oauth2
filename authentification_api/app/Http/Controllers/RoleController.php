<?php

namespace App\Http\Controllers;
use App\Models\Role;
use Illuminate\Http\Request;

class roleController extends Controller
{
    public function addRole(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $role = new Role;
        $role->name = $request->name;
        $role->save();

        return response()->json(['message' => 'Role added successfully', 'role' => $role], 201);
    }

    public function deleteRole($id)
    {
        $role = Role::find($id);
        $role->delete();

        if (!$role) {
            return response()->json(['message' => 'role not found'], 404);
        }

        return response()->json(['message' => 'role deleted successfully'], 200);
    }

    public function showRoles()
    {
        $roles = Role::all();
        return response()->json(['message' => 'Liste des rôles', 'roles' => $roles], 200);
    }

}
