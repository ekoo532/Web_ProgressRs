<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Setara dengan fungsi require_role() pada aplikasi PHP asli:
 * memastikan user sudah login DAN memiliki role yang sesuai
 * (admin / user) sebelum mengakses route tertentu.
 */
class EnsureUserHasRole
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (! $request->user()) {
            return redirect()->route('login');
        }

        if ($request->user()->role !== $role) {
            return redirect()->route('home');
        }

        return $next($request);
    }
}
