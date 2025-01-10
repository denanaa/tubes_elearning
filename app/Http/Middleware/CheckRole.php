<?php

// app/Http/Middleware/CheckRole.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  $role
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // Mengecek apakah user sudah login dan role-nya sesuai
        if (Auth::check() && Auth::user()->role !== $role) {
            return redirect('/'); // Redirect ke halaman utama jika role tidak sesuai
        }

        return $next($request); // Lanjutkan ke request berikutnya jika role sesuai
    }
}