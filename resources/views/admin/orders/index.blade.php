@extends('layouts.app')

@section('header')
    <h2 class="text-xl font-semibold text-pink-600 leading-tight text-center">
        All Gadget Orders 💻
    </h2>
@endsection

@section('content')
<div class="container mx-auto py-4 px-6" style="max-width: 900px;">
    @if ($orders->isEmpty())
        <p class="text-center text-gray-600 mt-6">No orders yet 😢</p>
    @else
        @foreach ($orders as $order)
            <div class="mb-6 p-4 bg-white border border-pink-200 rounded shadow">
                <p><strong>Customer:</strong> {{ $order->name }} ({{ $order->email }})</p>
                <p><strong>Address:</strong> {{ $order->address }}</p>
                <p><strong>Payment:</strong> {{ ucfirst($order->payment_type) }}</p>
                <p><strong>Total:</strong> ${{ number_format($order->total, 2) }}</p>

                <h4 class="mt-3 font-semibold text-gray-700">Items:</h4>
                <ul class="list-disc pl-5">
                    @foreach ($order->items as $item)
                        <li>{{ $item->product_name }} — {{ $item->quantity }} pcs @ ${{ number_format($item->price, 2) }}</li>
                    @endforeach
                </ul>
            </div>
        @endforeach
    @endif
</div>
@endsection
