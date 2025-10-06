@extends('layouts.app') 

@section('header')
    <h2 class="text-xl font-semibold text-pink-600 leading-tight text-center">
        Your Cart 🛒
    </h2>
@endsection

@section('content')
<div class="container" style="max-width: 800px; margin: auto;">
    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <a href="{{ route('shop') }}" style="display: inline-block; margin: 20px 0; color: #555;">⬅️ Back to Store</a>

    @if (empty($cart))
        <p>Your gadget cart is empty 😢</p>
    @else
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse; background: white; border-radius: 10px; overflow: hidden;">
                <thead style="background-color: #ffe4ec;">
                    <tr>
                        <th style="padding: 12px; text-align: left;">Gadget</th>
                        <th style="padding: 12px; text-align: left;">Price ($)</th>
                        <th style="padding: 12px; text-align: left;">Quantity</th>
                        <th style="padding: 12px; text-align: left;">Subtotal</th>
                        <th style="padding: 12px; text-align: left;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php $total = 0; @endphp
                    @foreach ($cart as $id => $item)
                        @php
                            $subtotal = $item['price'] * $item['quantity'];
                            $total += $subtotal;
                        @endphp
                        <tr style="border-bottom: 1px solid #f3c5cf;">
                            <td style="padding: 12px;">{{ $item['name'] }}</td>
                            <td style="padding: 12px;">${{ number_format($item['price'], 2) }}</td>
                            <td style="padding: 12px;">
                                <form action="{{ route('cart.update') }}" method="POST" style="display: flex; align-items: center; gap: 8px;">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $id }}">
                                    <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" style="width: 60px; padding: 5px; border: 1px solid #ccc; border-radius: 4px;">
                                    <button type="submit" style="background: #ff4d6d; color: white; padding: 6px 12px; border: none; border-radius: 5px;">
                                        ✅ Update
                                    </button>
                                </form>
                            </td>
                            <td style="padding: 12px;">${{ number_format($subtotal, 2) }}</td>
                            <td style="padding: 12px;">
                                <form action="{{ route('cart.remove', $id) }}" method="POST">
                                    @csrf
                                    <button type="submit" style="background: #ff4d6d; color: white; padding: 6px 12px; border: none; border-radius: 5px;">
                                        ❌ Remove
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    <tr style="background-color: #f8f8f8;">
                        <td colspan="3" style="text-align: right; padding: 12px;"><strong>Total:</strong></td>
                        <td colspan="2" style="padding: 12px;"><strong>${{ number_format($total, 2) }}</strong></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div style="margin-top: 30px;">
            <form action="{{ route('checkout.show') }}" method="GET">
                <button type="submit" style="background-color: purple; color: white; padding: 12px 25px; border: none; border-radius: 6px; font-weight: bold;">
                    🧾 Proceed to Checkout
                </button>
            </form>
        </div>
    @endif
</div>
@endsection
