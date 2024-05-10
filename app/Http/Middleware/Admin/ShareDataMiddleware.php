<?php

namespace App\Http\Middleware\Admin;

use App\Models\CartItem;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\SystemInfo;
use Illuminate\Support\Facades\View;
use App\Models\Category;
use App\Models\CartMD;
use App\Models\Order;

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
        $cart = CartMD::where('user_id', auth()->id())->first();
        $countCart = 0;
        if($cart){
            $cate_items = CartItem::where('cart_id', $cart->id)->get();
            $countCart = count($cate_items);
        }
        $notifications = Order::where('status', 'pending')->orderBy('order_date','desc')->get();
        
        View::share(['system_info' => $system_info, 'categories' => $categories, 'countCart' => $countCart , 'notifications' => $notifications]);
        return $next($request);
    }
}
