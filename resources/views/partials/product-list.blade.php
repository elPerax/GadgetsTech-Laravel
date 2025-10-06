@foreach ($products as $product) 
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; padding: 15px; border: 2px solid #ffccd5; background-color: white; border-radius: 12px; box-shadow: 2px 2px 10px rgba(0,0,0,0.05);">
        
        {{-- 🔧 Left: Gadget Info --}}
        <div style="flex: 1;">
            <h3 style="color: #ff4d6d; font-weight: 600;">{{ $product->name }}</h3>
            <p><strong>Category:</strong> {{ $product->category }}</p>
            <p><strong>Price:</strong> ${{ number_format($product->price, 2) }}</p>
            <p><strong>Stock:</strong> {{ $product->stock }}</p>

            @if ($product->stock > 0)
                <form action="{{ route('cart.add', $product->id) }}" method="POST" style="margin-top: 10px;">
                    @csrf
                    <button type="submit" class="add-to-cart-btn" style="background-color: #ff4d6d; color: white; padding: 8px 12px; border: none; border-radius: 5px;">
                        Add to Cart ⚙️
                    </button>
                </form>
            @else
                <p style="margin-top: 10px; color: gray; font-weight: bold;">Sold Out ❌</p>
            @endif
        </div>

        {{-- 🖼️ Right: Product Image --}}
        @if ($product->photo)
            <img src="{{ asset('storage/' . $product->photo) }}" alt="{{ $product->name }}"
                style="width: 160px; height: 160px; object-fit: cover; border-radius: 10px; margin-left: 20px;">
        @endif
    </div>
@endforeach
