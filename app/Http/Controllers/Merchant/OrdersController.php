<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderItem;
use App\SellerCompany;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrdersController extends Controller
{
    public function __construct()
    {
        return $this->middleware(['auth']);
    }

    public function orders($filterStatus = null, $date = null)
    {
        $user = Auth::user();
        $company = SellerCompany::where('owner_id', $user->id)->first();

        if(empty($filterStatus)){
            $orders = DB::table('orders')->whereJsonContains('seller_id', $company->id)->orderBy('id', 'DESC')->paginate(200);
        }elseif (!empty($filterStatus) && $filterStatus == 'new') {
            $orders = DB::table('orders')->whereJsonContains('seller_id', $company->id)->where('status', '=', 0)->orderBy('id', 'DESC')->paginate(200);
        }
        elseif (!empty($filterStatus) && $filterStatus == 'accepted') {
            $orders = DB::table('orders')->whereJsonContains('seller_id', $company->id)->where('status', '=', 7)->orderBy('id', 'DESC')->paginate(200);
        }
        elseif (!empty($filterStatus) && $filterStatus == 'denied') {
            $orders = DB::table('orders')->whereJsonContains('seller_id', $company->id)->where('status', '=', -1)->orderBy('id', 'DESC')->paginate(200);
        }

        $compact = compact('orders');
        return view('merchant.orders', $compact);
    }

    public function ordersByDate(Request $request)
    {
        $user = Auth::user();
        $company = SellerCompany::where('owner_id', $user->id)->first();

        if(empty($filterStatus)){
            $orders = DB::table('orders')->whereJsonContains('seller_id', $company->id)->whereDate('created_at', $request->bydate)->orderBy('id', 'DESC')->paginate(200);
        }elseif (!empty($filterStatus) && $filterStatus == 'new') {
            $orders = DB::table('orders')->whereJsonContains('seller_id', $company->id)->whereDate('created_at', $request->bydate)->where('status', '=', 0)->orderBy('id', 'DESC')->paginate(200);
        }
        elseif (!empty($filterStatus) && $filterStatus == 'accepted') {
            $orders = DB::table('orders')->whereJsonContains('seller_id', $company->id)->whereDate('created_at', $request->bydate)->where('status', '=', 7)->orderBy('id', 'DESC')->paginate(200);
        }
        elseif (!empty($filterStatus) && $filterStatus == 'denied') {
            $orders = DB::table('orders')->whereJsonContains('seller_id', $company->id)->whereDate('created_at', $request->bydate)->where('status', '=', -1)->orderBy('id', 'DESC')->paginate(200);
        }

        $date = $request->bydate;
        $compact = compact('orders', 'date');
        return view('merchant.orders', $compact);
    }

    public function order($id)
    {
        $user = Auth::user();
        $company = SellerCompany::where('owner_id', $user->id)->first();

        $order = Order::where('id', $id)->first();
        $order_items = OrderItem::where('order_id', $id)->get();

        $totalNumber = [];
        foreach($order_items as $item)
        {
            $totalNumber[] = $item->quantity;
        }
        $totalNumber = array_sum($totalNumber);

        $compact = compact('order', 'order_items', 'totalNumber');
        return view('merchant.order', $compact);
    }
}
