<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Practitioner;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    /**
     * Handle login for web users.
     */
    public function loginWeb(Request $request)
    {
        $validated = $request->validate([
            'role' => 'required|in:patient,practitioner,admin',
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $role = $validated['role'];
        $model = match ($role) {
            'patient' => Patient::class,
            'practitioner' => Practitioner::class,
            'admin' => Admin::class,
        };

        $user = $model::where('email', $validated['email'])->first();

        if (!$user || !Hash::check($validated['password'], $user->password)) {
            return back()->with('error', 'Invalid credentials');
        }

        $guard = $role;
        Auth::guard($guard)->login($user);
        $request->session()->regenerate();

        return redirect()->route('home');
    }

    /**
     * Show the registration form for web users.
     */
    public function showRegisterForm()
    {
        return view('register');
    }

    /**
     * Handle registration for web users.
     */
    public function registerWeb(Request $request)
    {
        $role = $request->input('role');
        $validated = $request->validate([
            'role' => 'required|in:patient,practitioner,admin',
            'email' => 'required|email|max:255|unique:patient,email|unique:practitioner,email|unique:admin,email',
            'password' => 'required|string|min:6',
            'full_name' => 'required_if:role,patient,practitioner|string|max:255',
            'staff_id' => 'required_if:role,admin|string|max:255',
        ]);

        $data = [
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ];

        if ($role === 'patient') {
            $data['full_name'] = $validated['full_name'];
            $user = Patient::create($data);
        } elseif ($role === 'practitioner') {
            $data['full_name'] = $validated['full_name'];
            $user = Practitioner::create($data);
        } else {
            $data['staff_id'] = $validated['staff_id'];
            $data['role'] = 'admin';
            $user = Admin::create($data);
        }

        $guard = $role;
        Auth::guard($guard)->login($user);

        return redirect()->route('home')->with('success', 'Registration successful!');
    }

    /**
     * Show the forgot password form for web users.
     */
    public function showForgotPasswordForm()
    {
        return view('forgot-password');
    }

    /**
     * Handle forgot password for web users.
     */
    public function forgotPasswordWeb(Request $request)
    {
        $validated = $request->validate([
            'role' => 'required|in:patient,practitioner,admin',
            'email' => 'required|email',
        ]);

        $model = match ($validated['role']) {
            'patient' => Patient::class,
            'practitioner' => Practitioner::class,
            'admin' => Admin::class,
        };

        $user = $model::where('email', $validated['email'])->first();

        if (!$user) {
            return back()->with('error', 'User not found');
        }

        $status = Password::broker('users')->sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with('status', 'Reset link sent to your email')
            : back()->with('error', 'Unable to send reset link');
    }

    /**
     * Show the reset password form for web users.
     */
    public function showResetPasswordForm($token)
    {
        return view('reset-password', ['token' => $token, 'email' => request()->email]);
    }

    /**
     * Handle reset password for web users.
     */
    public function resetPasswordWeb(Request $request)
    {
        $validated = $request->validate([
            'role' => 'required|in:patient,practitioner,admin',
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
        ]);

        $status = Password::broker('users')->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->password = Hash::make($password);
                $user->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', 'Password reset successfully')
            : back()->with('error', 'Unable to reset password');
    }

    /**
     * Handle logout for web users.
     */
    public function logoutWeb(Request $request)
    {
        $guard = Auth::getDefaultDriver();
        Auth::guard($guard)->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

    // API ROUTES

    /**
     * @OA\Post(
     *     path="/api/auth/register",
     *     summary="User Registration",
     *     description="Register a new user (admin, patient, or practitioner) and return an API token",
     *     tags={"Authentication"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"role", "email", "password"},
     *             @OA\Property(property="role", type="string", enum={"admin", "patient", "practitioner"}, example="patient"),
     *             @OA\Property(property="email", type="string", format="email", example="patient@example.com"),
     *             @OA\Property(property="password", type="string", format="password", example="password123"),
     *             @OA\Property(property="full_name", type="string", example="Jane Doe"),
     *             @OA\Property(property="staff_id", type="string", example="STAFF456")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="User registered successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="User registered successfully"),
     *             @OA\Property(property="user", type="object",
     *                 @OA\Property(property="patient_id", type="integer", example=1),
     *                 @OA\Property(property="email", type="string", example="patient@example.com"),
     *                 @OA\Property(property="full_name", type="string", example="Jane Doe")
     *             ),
     *             @OA\Property(property="token", type="string", example="1|abc123def456")
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
    public function register(Request $request)
    {
        $role = $request->input('role');
        $validated = $request->validate([
            'role' => 'required|in:patient,practitioner,admin',
            'email' => 'required|email|max:255|unique:patient,email|unique:practitioner,email|unique:admin,email',
            'password' => 'required|string|min:6',
            'full_name' => 'required_if:role,patient,practitioner|string|max:255',
            'staff_id' => 'required_if:role,admin|string|max:255',
        ]);

        $data = [
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ];

        if ($role === 'patient') {
            $data['full_name'] = $validated['full_name'];
            $user = Patient::create($data);
        } elseif ($role === 'practitioner') {
            $data['full_name'] = $validated['full_name'];
            $user = Practitioner::create($data);
        } else {
            $data['staff_id'] = $validated['staff_id'];
            $data['role'] = 'admin';
            $user = Admin::create($data);
        }

        $guard = $role;
        Auth::setDefaultDriver($guard);
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'User registered successfully',
            'user' => $user,
            'token' => $token,
        ], 201);
    }

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
     */
    public function login(Request $request)
    {
        $validated = $request->validate([
            'role' => 'required|in:patient,practitioner,admin',
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $role = $validated['role'];
        $model = match ($role) {
            'patient' => Patient::class,
            'practitioner' => Practitioner::class,
            'admin' => Admin::class,
        };

        $user = $model::where('email', $validated['email'])->first();

        if (!$user || !Hash::check($validated['password'], $user->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $guard = $role;
        Auth::setDefaultDriver($guard);
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Login successful',
            'user' => $user,
            'token' => $token,
        ], 200);
    }

    /**
     * @OA\Post(
     *     path="/api/auth/forgot-password",
     *     summary="Forgot Password",
     *     description="Generate a password reset code for a user",
     *     tags={"Authentication"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"role", "email"},
     *             @OA\Property(property="role", type="string", enum={"admin", "patient", "practitioner"}, example="patient"),
     *             @OA\Property(property="email", type="string", format="email", example="patient@example.com")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Password reset code generated",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Password reset code generated"),
     *             @OA\Property(property="reset_code", type="string", example="ABC123")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="User not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="User not found")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="The email field is required."),
     *             @OA\Property(property="errors", type="object",
     *                 @OA\Property(property="email", type="array",
     *                     @OA\Items(type="string", example="The email field is required.")
     *                 )
     *             )
     *         )
     *     )
     * )
     */
    public function forgotPassword(Request $request)
    {
        $validated = $request->validate([
            'role' => 'required|in:patient,practitioner,admin',
            'email' => 'required|email',
        ]);

        $model = match ($validated['role']) {
            'patient' => Patient::class,
            'practitioner' => Practitioner::class,
            'admin' => Admin::class,
        };

        $user = $model::where('email', $validated['email'])->first();

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $resetCode = Str::random(6);
        DB::table('reset_codes')->insert([
            'email' => $validated['email'],
            'reset_code' => $resetCode,
            'created_at' => now(),
            'expires_at' => now()->addMinutes(60),
        ]);

        return response()->json([
            'message' => 'Password reset code generated',
            'reset_code' => $resetCode,
        ], 200);
    }

    /**
     * @OA\Post(
     *     path="/api/auth/reset-password",
     *     summary="Reset Password",
     *     description="Reset a user's password using a reset code",
     *     tags={"Authentication"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"role", "email", "reset_code", "new_password"},
     *             @OA\Property(property="role", type="string", enum={"admin", "patient", "practitioner"}, example="patient"),
     *             @OA\Property(property="email", type="string", format="email", example="patient@example.com"),
     *             @OA\Property(property="reset_code", type="string", example="ABC123"),
     *             @OA\Property(property="new_password", type="string", format="password", example="newpassword123")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Password reset successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Password reset successfully")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="User not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="User not found")
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid reset code",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Invalid reset code or expired")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="The new password field is required."),
     *             @OA\Property(property="errors", type="object",
     *                 @OA\Property(property="new_password", type="array",
     *                     @OA\Items(type="string", example="The new password field is required.")
     *                 )
     *             )
     *         )
     *     )
     * )
     */
    public function resetPassword(Request $request)
    {
        $validated = $request->validate([
            'role' => 'required|in:patient,practitioner,admin',
            'email' => 'required|email',
            'reset_code' => 'required|string',
            'new_password' => 'required|string|min:6',
        ]);

        $model = match ($validated['role']) {
            'patient' => Patient::class,
            'practitioner' => Practitioner::class,
            'admin' => Admin::class,
        };

        $user = $model::where('email', $validated['email'])->first();

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $resetRecord = DB::table('reset_codes')
            ->where('email', $validated['email'])
            ->where('reset_code', $validated['reset_code'])
            ->where('expires_at', '>', now())
            ->first();

        if (!$resetRecord) {
            return response()->json(['message' => 'Invalid reset code or expired'], 400);
        }

        $user->password = Hash::make($validated['new_password']);
        $user->save();

        // حذف الـ reset code بعد الاستخدام
        DB::table('reset_codes')->where('email', $validated['email'])->delete();

        return response()->json(['message' => 'Password reset successfully'], 200);
    }
}