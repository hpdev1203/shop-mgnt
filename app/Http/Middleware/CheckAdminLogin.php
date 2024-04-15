<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Setup;

class CheckAdminLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $setup = Setup::first();
        if (!$setup || !$setup->is_completed) {
            return redirect()->route('admin.setup');
        }
        if (auth()->check() && auth()->user()->role === 'system') {
            return redirect()->route('admin');
        }
        return $next($request);
    }
}
