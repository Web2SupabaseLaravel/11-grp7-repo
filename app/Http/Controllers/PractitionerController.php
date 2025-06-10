<?php

namespace App\Http\Controllers;

use App\Models\Practitioner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PractitionerController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/practitioners",
     *     summary="Get List of Practitioners",
     *     description="Retrieve a list of all practitioners",
     *     tags={"Practitioners"},
     *     security={{"bearerAuth": {}}},
     *     @OA\Response(
     *         response=200,
     *         description="List of practitioners",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 @OA\Property(property="practitioner_id", type="integer", example=1),
     *                 @OA\Property(property="full_name", type="string", example="Dr. Smith"),
     *                 @OA\Property(property="email", type="string", example="dr.smith@example.com"),
     *                 @OA\Property(property="specialty", type="string", example="Cardiology")
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
        $practitioners = Practitioner::all();
        return response()->json($practitioners, 200);
    }

    /**
     * @OA\Get(
     *     path="/api/practitioners/{id}",
     *     summary="Get a Practitioner by ID",
     *     description="Retrieve details of a specific practitioner by ID",
     *     tags={"Practitioners"},
     *     security={{"bearerAuth": {}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Practitioner details",
     *         @OA\JsonContent(
     *             @OA\Property(property="practitioner_id", type="integer", example=1),
     *             @OA\Property(property="full_name", type="string", example="Dr. Smith"),
     *             @OA\Property(property="email", type="string", example="dr.smith@example.com"),
     *             @OA\Property(property="specialty", type="string", example="Cardiology")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Practitioner not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Practitioner not found")
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
        $practitioner = Practitioner::find($id);
        if (!$practitioner) {
            return response()->json(['message' => 'Practitioner not found'], 404);
        }
        return response()->json($practitioner, 200);
    }

    /**
     * @OA\Post(
     *     path="/api/practitioners",
     *     summary="Create a New Practitioner",
     *     description="Create a new practitioner record",
     *     tags={"Practitioners"},
     *     security={{"bearerAuth": {}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"email", "password", "full_name"},
     *             @OA\Property(property="email", type="string", format="email", example="practitioner@example.com"),
     *             @OA\Property(property="password", type="string", format="password", example="password123"),
     *             @OA\Property(property="full_name", type="string", example="Dr. Smith"),
     *             @OA\Property(property="specialty", type="string", example="Cardiology")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Practitioner created successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Practitioner created successfully"),
     *             @OA\Property(property="practitioner", type="object",
     *                 @OA\Property(property="practitioner_id", type="integer", example=1),
     *                 @OA\Property(property="full_name", type="string", example="Dr. Smith"),
     *                 @OA\Property(property="email", type="string", example="practitioner@example.com"),
     *                 @OA\Property(property="specialty", type="string", example="Cardiology")
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
        'email' => 'required|email|unique:practitioner,email', // Change "practitioners" to "practitioner"
        'password' => 'required|string|min:6',
        'full_name' => 'required|string|max:255',
    ]);

    $practitioner = Practitioner::create([
        'email' => $validated['email'],
        'password' => Hash::make($validated['password']),
        'full_name' => $validated['full_name'],
    ]);

    return response()->json([
        'message' => 'Practitioner created successfully',
        'practitioner' => $practitioner,
    ], 201);
}

    /**
     * @OA\Put(
     *     path="/api/practitioners/{id}",
     *     summary="Update a Practitioner",
     *     description="Update the details of a specific practitioner by ID",
     *     tags={"Practitioners"},
     *     security={{"bearerAuth": {}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer", example=2)
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="full_name", type="string", example="Dr. Smith Updated"),
     *             @OA\Property(property="email", type="string", format="email", example="dr.smith.updated@example.com"),
     *             @OA\Property(property="password", type="string", format="password", example="newpassword123"),
     *             @OA\Property(property="specialty", type="string", example="Cardiology")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Practitioner updated successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Practitioner updated successfully"),
     *             @OA\Property(property="practitioner", type="object",
     *                 @OA\Property(property="practitioner_id", type="integer", example=2),
     *                 @OA\Property(property="full_name", type="string", example="Dr. Smith Updated"),
     *                 @OA\Property(property="email", type="string", example="dr.smith.updated@example.com"),
     *                 @OA\Property(property="specialty", type="string", example="Cardiology")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Practitioner not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Practitioner not found")
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
    $practitioner = Practitioner::find($id);
    if (!$practitioner) {
        return response()->json(['message' => 'Practitioner not found'], 404);
    }

    $validated = $request->validate([
        'email' => 'email|unique:practitioner,email,' . $id . ',practitioner_id', // Specify the primary key column
        'password' => 'sometimes|string|min:6',
        'full_name' => 'sometimes|string|max:255',
        'specialty' => 'sometimes|string|max:255',
    ]);

    if (isset($validated['password'])) {
        $validated['password'] = Hash::make($validated['password']);
    }

    $practitioner->update($validated);

    return response()->json([
        'message' => 'Practitioner updated successfully',
        'practitioner' => $practitioner,
    ], 200);
}
    /**
     * @OA\Delete(
     *     path="/api/practitioners/{id}",
     *     summary="Delete a Practitioner",
     *     description="Delete a specific practitioner by ID",
     *     tags={"Practitioners"},
     *     security={{"bearerAuth": {}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer", example=2)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Practitioner deleted successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Practitioner deleted successfully")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Practitioner not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Practitioner not found")
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
    $practitioner = Practitioner::find($id);
    if (!$practitioner) {
        return response()->json(['message' => 'Practitioner not found'], 404);
    }

    // Delete related review records
    \App\Models\Review::where('practitioner_id', $id)->delete();

    // Delete related practitioner_offers_service records
    \App\Models\PractitionerOffersService::where('practitioner_id', $id)->delete();

    // Delete related medical records
    \App\Models\MedicalRecord::where('practitioner_id', $id)->delete();

    // Get related appointments
    $appointments = \App\Models\Appointment::where('practitioner_id', $id)->get();

    // Delete related service_under_appointment records
    foreach ($appointments as $appointment) {
        \App\Models\ServiceUnderAppointment::where('appointment_id', $appointment->appointment_id)->delete();
    }

    // Delete related patient_has_appointment records
    foreach ($appointments as $appointment) {
        \App\Models\PatientHasAppointment::where('appointment_id', $appointment->appointment_id)->delete();
    }

    // Delete related appointments
    \App\Models\Appointment::where('practitioner_id', $id)->delete();

    // Delete the practitioner
    $practitioner->delete();

    return response()->json(['message' => 'Practitioner deleted successfully'], 200);
}
}