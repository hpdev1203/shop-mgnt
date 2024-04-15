<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Setup;

class AdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|(string))  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        $setup = Setup::first();
        if (!$setup || !$setup->is_completed) {
            return redirect()->route('admin.setup');
        }
        if (!Auth::check() || Auth::user()->role !== 'system') {
            return redirect()->route('admin.login');
        }

        return $next($request);
    }
}
