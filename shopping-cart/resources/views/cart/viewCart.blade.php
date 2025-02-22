@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-center text-3xl font-bold text-gray-800 mb-6">🛒 Your Shopping Cart</h1>

    @if($cartItems->isEmpty())
        <p class="text-center text-lg text-gray-600">Your cart is empty!</p>
    @else
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <table class="min-w-full bg-white border border-gray-300">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="py-3 px-6 text-left">Product</th>
                        <th class="py-3 px-6 text-center">Quantity</th>
                        <th class="py-3 px-6 text-center">Price</th>
                        <th class="py-3 px-6 text-center">Discount</th>
                        <th class="py-3 px-6 text-center">Subtotal</th>
                        <th class="py-3 px-6 text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $totalAmount = 0;
                    @endphp
                    @foreach ($cartItems as $item)
                        @php
                            // Apply discount
                            
                            $finalPrice = $item->price - $item->discount_price;
                            $subtotal = $finalPrice * $item->quantity;
                            $totalAmount += $subtotal;
                        @endphp
                        <tr class="border-b border-gray-300">
                            <td class="py-4 px-6">{{ $item->product->name }}</td>
                            <td class="py-4 px-6 text-center">
                                <form action="{{ route('cart.update', $item->id) }}" method="POST" class="flex items-center justify-center">
                                    @csrf
                                    <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" class="w-16 border-gray-300 rounded px-2 py-1 text-center">
                                    <button type="submit" class="ml-2 bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">Update</button>
                                </form>
                            </td>
                            <td class="py-4 px-6 text-center">${{ number_format($item->price, 2) }}</td>
                            <td class="py-4 px-6 text-center text-green-600 font-bold">{{ $item->discount_price }}</td>
                            <td class="py-4 px-6 text-center font-semibold">${{ number_format($subtotal, 2) }}</td>
                            <td class="py-4 px-6 text-center">
                                <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">Remove</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-6 flex justify-end">
            <p class="text-lg font-bold">Total: ${{ number_format($totalAmount, 2) }}</p>
        </div>

        <div class="mt-6 flex justify-end">
            <a href="#" class="bg-green-500 text-white px-6 py-2 rounded-lg hover:bg-green-600">Proceed to Checkout</a>
        </div>
    @endif
</div>
@endsection
