@extends('layouts.app')

@section('header')
    <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 leading-tight">
        Checkout 🧾
    </h2>
@endsection

@section('content')
<div class="container">
    @if (session('error'))
        <p style="color: red;">{{ session('error') }}</p>
    @endif

    <h3>Your Order</h3>

    <ul>
        @php $total = 0; @endphp
        @foreach ($cart as $item)
            <li>
                {{ $item['name'] }} x {{ $item['quantity'] }} = ${{ $item['price'] * $item['quantity'] }}
            </li>
            @php $total += $item['price'] * $item['quantity']; @endphp
        @endforeach
    </ul>

    <p><strong>Total: ${{ $total }}</strong></p>

    <form action="{{ route('checkout.store') }}" method="POST" style="margin-top: 20px;">
        @csrf

        <label>Name:</label><br>
        <input type="text" name="name" required><br><br>

        <label>Email:</label><br>
        <input type="email" name="email" required><br><br>

        <label>Address:</label><br>
        <textarea name="address" required></textarea><br><br>

        <label>Payment Type:</label><br>
        <select name="payment_type" required>
            <option value="Cash on Delivery">Cash on Delivery</option>
            <option value="Credit Card">Credit Card</option>
        </select><br><br>

        <button type="submit">Place Order ✅</button>
    </form>
</div>
@endsection
