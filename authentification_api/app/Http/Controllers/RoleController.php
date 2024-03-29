<?php

namespace App\Http\Controllers;
use App\Models\Role;
use Illuminate\Http\Request;

class roleController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/roles",
     *     summary="Roles data",
     *     tags={"Roles"},
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

    /**
     * @OA\DELETE(
     *     path="/api/roles/{id}",
     *     summary="Delete roles",
     *     tags={"Roles"},
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

    public function deleteRole($id)
    {
        $role = Role::find($id);
        $role->delete();

        if (!$role) {
            return response()->json(['message' => 'role not found'], 404);
        }

        return response()->json(['message' => 'role deleted successfully'], 200);
    }

    /**
     * @OA\GET(
     *     path="/api/roles",
     *     summary="Read roles",
     *     tags={"Roles"},
     *     @OA\Parameter(
     *         name="read roles",
     *         in="query",
     *         description="en tant qu'admin, je peux afficher les roles",
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

    public function showRoles()
    {
        $this->authorize('viewAny', Role::class);
        $roles = Role::all();
        return response()->json(['message' => 'Liste des rôles', 'roles' => $roles], 200);
    }

}
