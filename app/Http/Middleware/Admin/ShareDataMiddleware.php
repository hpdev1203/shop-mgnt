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
use App\Models\ContactUser;
use Illuminate\Support\Facades\DB;

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
            $cate_items = CartItem::select('product_detail_id', DB::raw('count(*) as total'))->where('cart_id', $cart->id)->groupBy('product_detail_id')->get();
            $countCart = count($cate_items);
        }
        $notifications = Order::where('status', 'pending')->orderBy('order_date','desc')->get();
        $notification_contacts = ContactUser::where('is_view', '0')->orderBy('created_at','desc')->get();
        
        View::share(['system_info' => $system_info, 'categories' => $categories, 'countCart' => $countCart , 'notifications' => $notifications , 'notification_contacts' => $notification_contacts]);
        return $next($request);
    }
}
