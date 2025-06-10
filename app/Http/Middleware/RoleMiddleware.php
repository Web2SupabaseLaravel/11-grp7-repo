<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        $user = auth()->user();

        if (!$user) {
            Log::error('RoleMiddleware - No User Authenticated', [
                'request' => $request->all(),
            ]);
            return response()->json(['message' => 'Unauthenticated'], 401);
        }

        $userRole = null;
        try {
            if ($user instanceof \App\Models\Admin) {
                $userRole = 'admin';
            } elseif ($user instanceof \App\Models\Patient) {
                $userRole = 'patient';
            } elseif ($user instanceof \App\Models\Practitioner) {
                $userRole = 'practitioner';
            } else {
                Log::error('RoleMiddleware - Unknown User Type', [
                    'user_class' => get_class($user),
                ]);
                return response()->json(['message' => 'Unauthorized'], 403);
            }
        } catch (\Exception $e) {
            Log::error('RoleMiddleware - Error Retrieving Role', [
                'user_id' => $user->id ?? 'unknown',
                'user_email' => $user->email ?? 'unknown',
                'error' => $e->getMessage(),
            ]);
            return response()->json(['message' => 'Internal Server Error'], 500);
        }

        Log::info('RoleMiddleware - Role Check', [
            'user_id' => $user->id ?? 'unknown',
            'user_email' => $user->email ?? 'unknown',
            'expected_role' => $role,
            'user_role' => $userRole,
            'role_match' => $userRole === $role ? 'Yes' : 'No',
        ]);

        if ($userRole !== $role) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        return $next($request);
    }
}