<?php

namespace App\Http\Controllers\Swagger;

/**
 * @OA\Info(
 *     title="Online Clinic Booking API",
 *     version="1.0.0",
 *     description="API for managing online clinic bookings, including patients, practitioners, and admins.",
 *     @OA\Contact(
 *         email="support@onlineclinicbooking.com"
 *     )
 * )
 *
 * @OA\Server(
 *     url="http://localhost:8000",
 *     description="Local API Server"
 * )
 *
 * @OA\SecurityScheme(
 *     securityScheme="bearerAuth",
 *     type="http",
 *     scheme="bearer",
 *     bearerFormat="JWT",
 *     description="Enter the token in the format: Bearer {token}"
 * )
 */
class OpenApiAnnotations
{
    /**
     * @OA\Post(
     *     path="/api/auth/login",
     *     summary="User Login",
     *     description="Authenticate a user and return an API token",
     *     tags={"Authentication"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"role", "email", "password"},
     *             @OA\Property(property="role", type="string", enum={"admin", "patient", "practitioner"}, example="admin"),
     *             @OA\Property(property="email", type="string", format="email", example="admin@example.com"),
     *             @OA\Property(property="password", type="string", format="password", example="password123")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Login successful",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Login successful"),
     *             @OA\Property(property="user", type="object",
     *                 @OA\Property(property="admin_id", type="integer", example=1),
     *                 @OA\Property(property="email", type="string", example="admin@example.com"),
     *                 @OA\Property(property="staff_id", type="string", example="STAFF123"),
     *                 @OA\Property(property="role", type="string", example="admin")
     *             ),
     *             @OA\Property(property="token", type="string", example="1|abc123def456")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Invalid credentials",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Invalid credentials")
     *         )
     *     )
     * )
     *
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
}