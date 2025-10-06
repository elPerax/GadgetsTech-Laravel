<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class MyOrdersController extends Controller
{
    public function index()
    {
        $orders = Order::with('items')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('myorders.index', compact('orders'));
    }
}
