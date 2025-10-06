@extends('layouts.app')

@section('header')
    <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 leading-tight text-center" style="color: #ff1f6d;">
        Edit Gadget
    </h2>
@endsection

@section('content')
<div class="container" style="max-width: 600px; margin: auto; background: white; padding: 20px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);">
    @if ($errors->any())
        <div style="color: red; margin-bottom: 15px;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <label class="font-semibold">Name:</label><br>
        <input type="text" name="name" value="{{ $product->name }}" class="w-full mb-4 p-2 border border-gray-300 rounded" required><br>

        <label class="font-semibold">Category:</label><br>
        <input type="text" name="category" value="{{ $product->category }}" class="w-full mb-4 p-2 border border-gray-300 rounded" required><br>

        <label class="font-semibold">Price ($):</label><br>
        <input type="text" name="price" value="{{ $product->price }}" class="w-full mb-4 p-2 border border-gray-300 rounded" required><br>

        <label class="font-semibold">Stock:</label><br>
        <input type="number" name="stock" value="{{ $product->stock }}" class="w-full mb-4 p-2 border border-gray-300 rounded" required><br>

        <label class="font-semibold">Change Image (Optional):</label><br>
        <input type="file" name="photo" class="w-full mb-4"><br>

        @if ($product->photo)
            <p class="text-sm mb-2 text-gray-600">Current Image:</p>
            <img src="{{ asset('storage/' . $product->photo) }}" alt="Gadget Image" style="max-height: 120px; border-radius: 10px; margin-bottom: 20px;">
        @endif

        <button type="submit" style="background-color: #ff4d6d; color: white; padding: 10px 20px; border-radius: 5px;">
            Update Gadget
        </button>
    </form>
</div>
@endsection
