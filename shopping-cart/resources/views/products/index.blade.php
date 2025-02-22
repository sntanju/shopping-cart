@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4 text-3xl font-bold">🛒 Product List</h1>

    <!-- Use Tailwind grid system for responsive layout -->
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-6">
        @foreach ($products as $product)
            <div class="card shadow-lg rounded-lg overflow-hidden">
                <img src="{{ asset('storage/products/' . $product->image) }}" 
                     class="card-img-top w-full h-48 object-cover transition-transform transform hover:scale-105"
                     alt="{{ $product->name }}">
                
                <div class="card-body p-4 text-center">
                    <!-- Product Name -->
                    <h5 class="card-title text-xl font-semibold text-gray-800 mb-2 truncate">{{ $product->name }}</h5>
                    
                    <!-- Product Description -->
                    <p class="text-sm text-gray-600 mb-4">{{ $product->description }}</p>

                    <!-- Product Price -->
                    <p class="card-text mb-4 text-gray-600">
                        <strong class="text-gray-800">Price:</strong>
                        <span class="text-green-500 text-lg">${{ number_format($product->price, 2) }}</span>
                    </p>

                    <!-- Product Discount Price -->
                    <p class="card-text mb-4 text-gray-600">
                        <strong class="text-gray-800">Discount Price:</strong>
                        <span class="text-green-500 text-lg">${{ number_format($product->discount_price, 2) }}</span>
                    </p>

                    <!-- Add to Cart Button -->
                    
                    <form action="{{ route('cart.add', $product->id) }}" method="POST">
                        @csrf
                        <button type="submit" 
                                class="btn btn-primary w-full py-2 px-4 bg-blue-500 text-white rounded-lg shadow-md transition-colors hover:bg-blue-600 focus:outline-none">
                            🛍 Add to Cart
                        </button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
