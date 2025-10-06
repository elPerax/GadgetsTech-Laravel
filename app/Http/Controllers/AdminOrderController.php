<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('items')->latest()->paginate(10);

        return view('admin.orders.index', compact('orders'));
    }
}
