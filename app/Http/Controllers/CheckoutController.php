<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function show()
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('shop')->with('error', 'Cart is empty!');
        }

        return view('checkout', compact('cart'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'address' => 'required',
            'payment_type' => 'required',
        ]);

        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('shop')->with('error', 'Cart is empty!');
        }

        foreach ($cart as $item) {
            $product = Product::where('name', $item['name'])->first();
            if (!$product || $product->stock < $item['quantity']) {
                return redirect()->route('cart.index')->with('error', "Not enough stock for {$item['name']}");
            }
        }

       
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        $order = Order::create([
            'user_id' => auth()->check() ? auth()->id() : null,
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'payment_type' => $request->payment_type,
            'total' => $total,
        ]);

        foreach ($cart as $item) {
            
            OrderItem::create([
                'order_id' => $order->id,
                'product_name' => $item['name'],
                'price' => $item['price'],
                'quantity' => $item['quantity'],
            ]);

          
            $product = Product::where('name', $item['name'])->first();
            if ($product) {
                $product->stock -= $item['quantity'];
                $product->save();
            }
        }

        session()->forget('cart');

        return redirect()->route('checkout.thankyou')->with('success', 'Order placed successfully!');
    }
}
