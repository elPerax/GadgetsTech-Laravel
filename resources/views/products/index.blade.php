@extends('layouts.app')

@section('header')
    <h2 class="text-xl font-semibold text-center" style="color: #ff1f6d;">
        All Gadgets
    </h2>
@endsection

@section('content')
<div class="container" style="max-width: 900px; margin: auto;">
    @if (session('success'))
        <div style="color: green; margin-bottom: 15px;">{{ session('success') }}</div>
    @endif

    <a href="{{ route('products.create') }}" style="display: inline-block; margin-bottom: 15px; font-weight: 500;">
        ➕ Add gadget
    </a>

    <table style="width: 100%; border-collapse: collapse; background: white; border-radius: 10px; overflow: hidden;">
        <thead style="background-color: #ffe6ec;">
            <tr style="text-align: left;">
                <th style="padding: 12px;">Name</th>
                <th style="padding: 12px;">Category</th>
                <th style="padding: 12px;">Price ($)</th>
                <th style="padding: 12px;">Stock</th>
                <th style="padding: 12px;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
            <tr style="border-bottom: 1px solid #f5c2c7;">
                <td style="padding: 12px;">{{ $product->name }}</td>
                <td style="padding: 12px;">{{ $product->category }}</td>
                <td style="padding: 12px;">${{ number_format($product->price, 2) }}</td>
                <td style="padding: 12px;">{{ $product->stock }}</td>
                <td style="padding: 12px;">
                    <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                        <a href="{{ route('products.edit', $product->id) }}" style="background-color: #ffa1b5; padding: 6px 12px; border-radius: 5px; color: white; text-decoration: none;">✏️ Edit</a>
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Delete this Gadget?')" style="background-color: #ff4d6d; padding: 6px 12px; border: none; border-radius: 5px; color: white;">
                                🗑️ Delete
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
