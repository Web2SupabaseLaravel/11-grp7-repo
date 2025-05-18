<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/admins",
     *     summary="Get List of Admins",
     *     description="Retrieve a list of all admins",
     *     tags={"Admins"},
     *     security={{"bearerAuth": {}}},
     *     @OA\Response(
     *         response=200,
     *         description="List of admins",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 @OA\Property(property="admin_id", type="integer", example=1),
     *                 @OA\Property(property="email", type="string", example="admin@example.com"),
     *                 @OA\Property(property="staff_id", type="string", example="STAFF123")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Unauthenticated")
     *         )
     *     )
     * )
     */
    public function index()
    {
        $admins = Admin::all();
        return response()->json($admins, 200);
    }

    /**
     * @OA\Get(
     *     path="/api/admins/{id}",
     *     summary="Get an Admin by ID",
     *     description="Retrieve details of a specific admin by ID",
     *     tags={"Admins"},
     *     security={{"bearerAuth": {}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Admin details",
     *         @OA\JsonContent(
     *             @OA\Property(property="admin_id", type="integer", example=1),
     *             @OA\Property(property="email", type="string", example="admin@example.com"),
     *             @OA\Property(property="staff_id", type="string", example="STAFF123")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Admin not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Admin not found")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Unauthenticated")
     *         )
     *     )
     * )
     */
    public function show($id)
    {
        $admin = Admin::find($id);
        if (!$admin) {
            return response()->json(['message' => 'Admin not found'], 404);
        }
        return response()->json($admin, 200);
    }

    /**
     * @OA\Post(
     *     path="/api/admins",
     *     summary="Create a New Admin",
     *     description="Create a new admin record",
     *     tags={"Admins"},
     *     security={{"bearerAuth": {}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"email", "password", "staff_id"},
     *             @OA\Property(property="email", type="string", format="email", example="newadmin@example.com"),
     *             @OA\Property(property="password", type="string", format="password", example="password123"),
     *             @OA\Property(property="staff_id", type="string", example="STAFF456")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Admin created successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Admin created successfully"),
     *             @OA\Property(property="admin", type="object",
     *                 @OA\Property(property="admin_id", type="integer", example=2),
     *                 @OA\Property(property="email", type="string", example="newadmin@example.com"),
     *                 @OA\Property(property="staff_id", type="string", example="STAFF456")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="The email has already been taken."),
     *             @OA\Property(property="errors", type="object",
     *                 @OA\Property(property="email", type="array",
     *                     @OA\Items(type="string", example="The email has already been taken.")
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Unauthenticated")
     *         )
     *     )
     * )
     */
    public function store(Request $request)
{
    $validated = $request->validate([
        'email' => 'required|email|unique:admin,email', // Change "admins" to "admin"
        'password' => 'required|string|min:6',
        'staff_id' => 'required|string|max:255',
    ]);

    $admin = Admin::create([
        'email' => $validated['email'],
        'password' => Hash::make($validated['password']),
        'staff_id' => $validated['staff_id'],
        'role' => 'admin',
    ]);

    return response()->json([
        'message' => 'Admin created successfully',
        'admin' => $admin,
    ], 201);
}

    /**
     * @OA\Put(
     *     path="/api/admins/{id}",
     *     summary="Update an Admin",
     *     description="Update the details of a specific admin by ID",
     *     tags={"Admins"},
     *     security={{"bearerAuth": {}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="email", type="string", format="email", example="admin.updated@example.com"),
     *             @OA\Property(property="password", type="string", format="password", example="newpassword123"),
     *             @OA\Property(property="staff_id", type="string", example="STAFF123_UPDATED")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Admin updated successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Admin updated successfully"),
     *             @OA\Property(property="admin", type="object",
     *                 @OA\Property(property="admin_id", type="integer", example=1),
     *                 @OA\Property(property="email", type="string", example="admin.updated@example.com"),
     *                 @OA\Property(property="staff_id", type="string", example="STAFF123_UPDATED")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Admin not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Admin not found")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Unauthenticated")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="The email has already been taken."),
     *             @OA\Property(property="errors", type="object",
     *                 @OA\Property(property="email", type="array",
     *                     @OA\Items(type="string", example="The email has already been taken.")
     *                 )
     *             )
     *         )
     *     )
     * )
     */
   public function update(Request $request, $id)
{
    $admin = Admin::find($id);
    if (!$admin) {
        return response()->json(['message' => 'Admin not found'], 404);
    }

    $validated = $request->validate([
        'email' => 'email|unique:admin,email,' . $id . ',admin_id', // Specify the primary key column
        'password' => 'sometimes|string|min:6',
        'staff_id' => 'sometimes|string|max:255',
    ]);

    if (isset($validated['password'])) {
        $validated['password'] = Hash::make($validated['password']);
    }

    $admin->update($validated);

    return response()->json([
        'message' => 'Admin updated successfully',
        'admin' => $admin,
    ], 200);
}
    /**
     * @OA\Delete(
     *     path="/api/admins/{id}",
     *     summary="Delete an Admin",
     *     description="Delete a specific admin by ID",
     *     tags={"Admins"},
     *     security={{"bearerAuth": {}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Admin deleted successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Admin deleted successfully")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Admin not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Admin not found")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Unauthenticated")
     *         )
     *     )
     * )
     */
    public function destroy($id)
    {
        $admin = Admin::find($id);
        if (!$admin) {
            return response()->json(['message' => 'Admin not found'], 404);
        }

        $admin->delete();

        return response()->json(['message' => 'Admin deleted successfully'], 200);
    }
}