<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Show the cart page.
     */
    public function index()
    {
        // Load cart items with their product details
        $cartItems = Cart::with('product')
            ->where('user_id', Auth::id())
            ->get();

        // Calculate total
        $total = $cartItems->sum(fn($item) => $item->subtotal());

        return view('cart.index', compact('cartItems', 'total'));
    }

    /**
     * Add a product to the cart.
     */
    public function store(Request $request, Product $product)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1|max:' . $product->stock,
        ]);

        // Check if this product is already in the user's cart
        $cartItem = Cart::where('user_id', Auth::id())
            ->where('product_id', $product->id)
            ->first();

        if ($cartItem) {
            // Increase quantity (but not beyond stock)
            $newQty = min($cartItem->quantity + $request->quantity, $product->stock);
            $cartItem->update(['quantity' => $newQty]);
        } else {
            // Create new cart entry
            Cart::create([
                'user_id'    => Auth::id(),
                'product_id' => $product->id,
                'quantity'   => $request->quantity,
            ]);
        }

        return redirect()->route('cart.index')
            ->with('success', '"' . $product->name . '" added to cart!');
    }

    /**
     * Update quantity of a cart item.
     */
    public function update(Request $request, Cart $cart)
    {
        if ($cart->user_id !== Auth::id()) abort(403);

        $request->validate(['quantity' => 'required|integer|min:1']);

        $cart->update(['quantity' => $request->quantity]);

        return back()->with('success', 'Cart updated.');
    }

    /**
     * Remove an item from the cart.
     */
    public function destroy(Cart $cart)
    {
        if ($cart->user_id !== Auth::id()) abort(403);

        $cart->delete();

        return back()->with('success', 'Item removed from cart.');
    }
}
