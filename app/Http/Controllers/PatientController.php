<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PatientController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/patients",
     *     summary="Get List of Patients",
     *     description="Retrieve a list of all patients",
     *     tags={"Patients"},
     *     security={{"bearerAuth": {}}},
     *     @OA\Response(
     *         response=200,
     *         description="List of patients",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 @OA\Property(property="patient_id", type="integer", example=1),
     *                 @OA\Property(property="full_name", type="string", example="John Doe"),
     *                 @OA\Property(property="email", type="string", example="john.doe@example.com")
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
        $patients = Patient::all();
        return response()->json($patients, 200);
    }

    /**
     * @OA\Get(
     *     path="/api/patients/{id}",
     *     summary="Get a Patient by ID",
     *     description="Retrieve details of a specific patient by ID",
     *     tags={"Patients"},
     *     security={{"bearerAuth": {}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Patient details",
     *         @OA\JsonContent(
     *             @OA\Property(property="patient_id", type="integer", example=1),
     *             @OA\Property(property="full_name", type="string", example="John Doe"),
     *             @OA\Property(property="email", type="string", example="john.doe@example.com")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Patient not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Patient not found")
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
        $patient = Patient::find($id);
        if (!$patient) {
            return response()->json(['message' => 'Patient not found'], 404);
        }
        return response()->json($patient, 200);
    }

    /**
     * @OA\Post(
     *     path="/api/patients",
     *     summary="Create a New Patient",
     *     description="Create a new patient record",
     *     tags={"Patients"},
     *     security={{"bearerAuth": {}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"email", "password", "full_name"},
     *             @OA\Property(property="email", type="string", format="email", example="patient@example.com"),
     *             @OA\Property(property="password", type="string", format="password", example="password123"),
     *             @OA\Property(property="full_name", type="string", example="Jane Doe")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Patient created successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Patient created successfully"),
     *             @OA\Property(property="patient", type="object",
     *                 @OA\Property(property="patient_id", type="integer", example=1),
     *                 @OA\Property(property="full_name", type="string", example="Jane Doe"),
     *                 @OA\Property(property="email", type="string", example="patient@example.com")
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
        'email' => 'required|email|unique:patient,email', // Change "patients" to "patient"
        'password' => 'required|string|min:6',
        'full_name' => 'required|string|max:255',
    ]);

    $patient = Patient::create([
        'email' => $validated['email'],
        'password' => Hash::make($validated['password']),
        'full_name' => $validated['full_name'],
    ]);

    return response()->json([
        'message' => 'Patient created successfully',
        'patient' => $patient,
    ], 201);
}
    /**
     * @OA\Put(
     *     path="/api/patients/{id}",
     *     summary="Update a Patient",
     *     description="Update the details of a specific patient by ID",
     *     tags={"Patients"},
     *     security={{"bearerAuth": {}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer", example=8)
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="full_name", type="string", example="John Doe Updated"),
     *             @OA\Property(property="email", type="string", format="email", example="john.doe.updated@example.com"),
     *             @OA\Property(property="password", type="string", format="password", example="newpassword123")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Patient updated successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Patient updated successfully"),
     *             @OA\Property(property="patient", type="object",
     *                 @OA\Property(property="patient_id", type="integer", example=8),
     *                 @OA\Property(property="full_name", type="string", example="John Doe Updated"),
     *                 @OA\Property(property="email", type="string", example="john.doe.updated@example.com")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Patient not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Patient not found")
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
    $patient = Patient::find($id);
    if (!$patient) {
        return response()->json(['message' => 'Patient not found'], 404);
    }

    $validated = $request->validate([
        'email' => 'email|unique:patient,email,' . $id . ',patient_id', // Specify the primary key column
        'password' => 'sometimes|string|min:6',
        'full_name' => 'sometimes|string|max:255',
    ]);

    if (isset($validated['password'])) {
        $validated['password'] = Hash::make($validated['password']);
    }

    $patient->update($validated);

    return response()->json([
        'message' => 'Patient updated successfully',
        'patient' => $patient,
    ], 200);
}

    /**
     * @OA\Delete(
     *     path="/api/patients/{id}",
     *     summary="Delete a Patient",
     *     description="Delete a specific patient by ID",
     *     tags={"Patients"},
     *     security={{"bearerAuth": {}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer", example=8)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Patient deleted successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Patient deleted successfully")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Patient not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Patient not found")
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
        $patient = Patient::find($id);
        if (!$patient) {
            return response()->json(['message' => 'Patient not found'], 404);
        }

        $patient->delete();

        return response()->json(['message' => 'Patient deleted successfully'], 200);
    }
}