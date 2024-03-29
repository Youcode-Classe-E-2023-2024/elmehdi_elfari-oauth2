<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permission;

class PermissionController extends Controller
{
    /**
     * @OA\Schema(
     *     schema="Permission",
     *     required={"id", "name"},
     *     @OA\Property(
     *         property="id",
     *         type="integer",
     *         format="int64",
     *         description="The unique identifier for the permission"
     *     ),
     *     @OA\Property(
     *         property="name",
     *         type="string",
     *         description="The name of the permission"
     *     )
     * )
     */

    /**
     * @OA\Post(
     *     path="/api/permissions",
     *     summary="Permissions data",
     *     tags={"Permissions"},
     *     @OA\Parameter(
     *         name="name",
     *         in="query",
     *         description="",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="criteria",
     *         in="query",
     *         description="Some optional other parameter",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Returns some sample category things",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied.",
     *     ),
     * )
     */
    public function addPermission(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
        ]);

        $permission = new Permission;
        $permission->name = $request->name;
        $permission->save();

        return response()->json(['message' => 'Permission added successfully', 'permission' => $permission], 201);
    }

    /**
     * @OA\Delete(
     *     path="/api/permissions/{id}",
     *     summary="Delete a permission",
     *     tags={"Permissions"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the permission to delete",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Permission deleted successfully"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Permission not found"
     *     )
     * )
     */
    public function deletePermission($id)
    {
        $permission = Permission::find($id);

        if (!$permission) {
            return response()->json(['message' => 'Permission not found'], 404);
        }

        $permission->delete();

        return response()->json(['message' => 'Permission deleted successfully'], 200);
    }

    /**
     * @OA\Get(
     *     path="/api/permissions",
     *     summary="List all permissions",
     *     tags={"Permissions"},
     *     @OA\Parameter(
     *         name="read_permissions",
     *         in="query",
     *         description="Indicates the action of reading permissions",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="criteria",
     *         in="query",
     *         description="Some optional other parameter",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Returns a list of permissions",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Permission")
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Error: Bad request. When required parameters were not supplied.",
     *     ),
     * )
     */
    public function showPermissions()
    {
        $permissions = Permission::all();
        return response()->json(['message' => 'List of permissions', 'permissions' => $permissions], 200);
    }

}
