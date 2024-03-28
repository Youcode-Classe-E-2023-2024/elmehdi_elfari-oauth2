<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permission;

class PermissionController extends Controller
{
    public function addPermission(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $permission = new Permission;
        $permission->name = $request->name;
        $permission->save();

        return response()->json(['message' => 'Permission added successfully', 'permission' => $permission], 201);
    }

    public function deletePermission($id)
    {
        $permission = Permission::find($id);

        if (!$permission) {
            return response()->json(['message' => 'Permission not found'], 404);
        }

        $permission->delete();

        return response()->json(['message' => 'Permission deleted successfully'], 200);
    }

    public function showPermissions()
    {
        $permissions = Permission::all();
        return response()->json(['message' => 'List of permissions', 'permissions' => $permissions], 200);
    }
}

