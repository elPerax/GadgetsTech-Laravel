@extends('layouts.app')

@section('header')
    <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 leading-tight">
        My tech gadgets Orders 
    </h2>
@endsection

@section('content')
<div class="container">
    @if ($orders->isEmpty())
        <p>You haven't ordered anything yet! 🫢</p>
    @else
        @foreach ($orders as $order)
            <div style="border: 1px solid #ccc; padding: 15px; margin-bottom: 20px;">
                <p><strong>Order ID:</strong> {{ $order->id }}</p>
                <p><strong>Date:</strong> {{ $order->created_at->format('M d, Y') }}</p>
                <p><strong>Total:</strong> ${{ $order->total }}</p>

                <ul style="margin-top: 10px;">
                    @foreach ($order->items as $item)
                        <li>{{ $item->product_name }} — {{ $item->quantity }} × ${{ $item->price }}</li>
                    @endforeach
                </ul>
            </div>
        @endforeach
    @endif
</div>
@endsection
