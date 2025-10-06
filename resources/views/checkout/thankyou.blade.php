@extends('layouts.app')

@section('header')
    <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 leading-tight">
        Thank You! 🙏
    </h2>
@endsection

@section('content')
<div class="container" style="margin-top: 30px;">
    <h3>🎉 Your order has been placed successfully!</h3>
    <p style="margin-top: 10px;">We’re preparing your Gadgets  💻 and will notify you when they’re ready!</p>

    <a href="{{ route('shop') }}" style="margin-top: 20px; display: inline-block;">
        ⬅️ Back to Shop
    </a>
</div>
@endsection
