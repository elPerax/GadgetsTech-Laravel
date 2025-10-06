@extends('layouts.app') 

@section('header')
    <h2 class="text-xl font-semibold leading-tight text-center" style="color: #ff1f6d;">
        Welcome to Sam & Shawn Custom Gadget Store
    </h2>
@endsection

@section('content')
<div class="container">
    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <div class="flex justify-end mb-4">
        <a href="{{ route('cart.index') }}" class="text-gray-800 hover:text-pink-600 font-medium">🛒 View Cart</a>
    </div>

    <h3 style="margin-bottom: 10px;">All Tech Gadgets</h3>

    <input
        type="text"
        id="search"
        placeholder="Search by name or category..."
        style="width: 100%; padding: 10px; margin-bottom: 20px; border: 1px solid #ccc; border-radius: 5px;"
    >

    <div id="product-list">
        @include('partials.product-list', ['products' => $products])
    </div>

    {{-- ✅ Pagination --}}
    <div class="mt-6 text-center">
        {{ $products->links() }}
    </div>
</div>

<script>
    document.getElementById('search').addEventListener('keyup', function () {
        let query = this.value;

        fetch(`{{ url('/search') }}?query=${encodeURIComponent(query) }`)
            .then(response => response.text())
            .then(data => {
                document.getElementById('product-list').innerHTML = data;
            });
    });
</script>
@endsection
