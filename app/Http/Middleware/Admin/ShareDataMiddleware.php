<?php

namespace App\Http\Middleware\Admin;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\SystemInfo;
use Illuminate\Support\Facades\View;
use App\Models\Category;

class ShareDataMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $system_info = SystemInfo::first();
        $categories = Category::where('parent_id', null)->get();
        View::share(['system_info' => $system_info, 'categories' => $categories]);
        return $next($request);
    }
}
