<?php

namespace App\Http\Controllers;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;


use Illuminate\Http\Request;

class CartItemController extends Controller
{
    
    public function add(Request $request, $productId)
    {
        // Get the currently authenticated user
        $user = auth()->user();

        // Find the product by its ID
        $product = Product::findOrFail($productId);
        

        // Check if the product is already in the user's cart
        $cartItem = CartItem::where('user_id', $user->id)
                            ->where('product_id', $product->id)
                            ->first();

        if ($cartItem) {
            // If the product is already in the cart, just update the quantity
            $cartItem->quantity++;
            $cartItem->save();
        } else {
            // If the product is not in the cart, add a new cart item
            CartItem::create([
                'user_id' => Auth::id(), 
                'product_id' => $product->id,
                'quantity' => 1,
                'price' => $product->price,
                'discount_price' => $product->discount_price,
            ]);
        }

        return redirect()->route('products.index')->with('success', 'Product added to cart!');
    }

    // View cart items
    public function viewCart()
{
    $user = auth()->user();
    $cartItems = CartItem::where('user_id', $user->id)->with('product')->get();

    return view('cart.viewCart', compact('cartItems'));
}


    // Update cart item quantity
    public function updateQuantity(Request $request, $cartItemId)
    {
        $cartItem = CartItem::findOrFail($cartItemId);
        $cartItem->update([
            'quantity' => $request->quantity
        ]);

        return redirect()->route('cart.view')->with('success', 'Cart updated!');
    }

    // Remove item from cart
    public function removeItem($cartItemId)
    {
        $cartItem = CartItem::findOrFail($cartItemId);
        $cartItem->delete();

        return redirect()->route('cart.view')->with('success', 'Product removed from cart!');
    }
}
