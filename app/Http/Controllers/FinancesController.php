<?php

namespace App\Http\Controllers;

use App\Order;
use App\SellerCompany;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FinancesController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $company = SellerCompany::where('owner_id', $user->id)->first();

        $revenue = 0;
        $percentage = 0;
        $profit = 0;

        $check_seller_order = DB::table('orders')->whereJsonContains('seller_id', $company->id)->get();
        if (!empty($check_seller_order)) {
            $revenue = DB::table('orders')->whereJsonContains('seller_id', $company->id)->sum("subtotal");
            $percentage = ($revenue / 100) * 5;
            $profit = $revenue - $percentage;
        }

        $ordersCount = DB::table('orders')->select(
            "orders.*",
            DB::raw("order_items.name as product_name"),
            DB::raw("order_items.quantity"),
            DB::raw("order_items.price")
            )
        ->whereJsonContains('orders.seller_id', $company->id)
        ->count();

        $compact = compact('revenue', 'percentage', 'profit', 'ordersCount');

        return view('merchant.finance', $compact);
    }
}
