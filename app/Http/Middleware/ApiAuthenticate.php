<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class ApiAuthenticate extends Middleware
{
    public function handle($request, \Closure $next, ...$guards)
    {
        $this->authenticate($request, $guards);
        return $next($request);
    }

  protected function redirectTo(Request $request): ?string
{
    if ($request->expectsJson()) {
        return null;
    }
    return route('login');
}

protected function unauthenticated($request, array $guards)
{
    if ($request->expectsJson()) {
        response()->json(['message' => 'Unauthenticated'], 401)->send();
        exit;
    }

    parent::unauthenticated($request, $guards);
}
}