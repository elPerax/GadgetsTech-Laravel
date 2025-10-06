@extends('layouts.app')

@section('header')
    <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 leading-tight text-center" style="color: #ff1f6d;">
        Add New tech gadget 
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

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <label class="font-semibold">Name:</label><br>
        <input type="text" name="name" class="w-full mb-4 p-2 border border-gray-300 rounded" required><br>

        <label class="font-semibold">Category:</label><br>
        <input type="text" name="category" class="w-full mb-4 p-2 border border-gray-300 rounded" required><br>

        <label class="font-semibold">Price ($):</label><br>
        <input type="text" name="price" class="w-full mb-4 p-2 border border-gray-300 rounded" required><br>

        <label class="font-semibold">Stock:</label><br>
        <input type="number" name="stock" class="w-full mb-4 p-2 border border-gray-300 rounded" required><br>

        <label class="font-semibold">Image (Optional):</label><br>
        <input type="file" name="photo" class="w-full mb-4"><br>

        <button type="submit" style="background-color: #ff4d6d; color: white; padding: 10px 20px; border-radius: 5px;">
            Add gadget 
        </button>
    </form>
</div>
@endsection
