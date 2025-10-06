<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required',
            'category' => 'required',
            'price'    => 'required|numeric',
            'stock'    => 'required|integer',
            'photo'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('photo')) {
            $filename = $request->file('photo')->store('products', 'public');
            $data['photo'] = $filename;
        }

        Product::create($data);

        return redirect()->route('products.index')->with('success', 'Product created!');
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name'     => 'required',
            'category' => 'required',
            'price'    => 'required|numeric',
            'stock'    => 'required|integer',
            'photo'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('photo')) {
            if ($product->photo && Storage::disk('public')->exists($product->photo)) {
                Storage::disk('public')->delete($product->photo);
            }

            $filename = $request->file('photo')->store('products', 'public');
            $data['photo'] = $filename;
        }

        $product->update($data);

        return redirect()->route('products.index')->with('success', 'Product updated!');
    }

    public function destroy(Product $product)
    {
        if ($product->photo && Storage::disk('public')->exists($product->photo)) {
            Storage::disk('public')->delete($product->photo);
        }

        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted!');
    }

    
    public function shop()
    {
        $products = Product::paginate(6);
        return view('shop', compact('products'));
    }

   
    public function search(Request $request)
    {
        $query = $request->query('query');
        $products = Product::where('name', 'like', "%{$query}%")
                           ->orWhere('category', 'like', "%{$query}%")
                           ->get();

        return view('partials.product-list', compact('products'));
    }
}
