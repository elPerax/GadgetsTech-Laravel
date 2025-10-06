<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('cart', compact('cart'));
    }

    public function add(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "name" => $product->name,
                "price" => $product->price,
                "quantity" => 1
            ];
        }

        session()->put('cart', $cart);
        return redirect()->route('cart.index')->with('success', 'Candy added to cart!');
    }

    public function update(Request $request)
    {
        $id = $request->input('id');
        $quantity = max(1, (int) $request->input('quantity')); // prevent 0 or negative
    
        $cart = session()->get('cart', []);
    
        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $quantity;
            session()->put('cart', $cart);
            return redirect()->route('cart.index')->with('success', 'Cart updated!');
        }
    
        return redirect()->route('cart.index')->with('error', 'Item not found in cart!');
    }
    


    public function remove(Request $request, $id)
    {
        $cart = session()->get('cart');
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        return redirect()->route('cart.index')->with('success', 'Candy removed from cart!');
    }
}
