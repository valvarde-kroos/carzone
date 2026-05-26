<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Show the checkout form.
     */
    public function create()
    {
        // Load cart items for the order summary
        $cartItems = Cart::with('product')
            ->where('user_id', Auth::id())
            ->get();

        // Redirect back if cart is empty
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')
                ->with('error', 'Your cart is empty!');
        }

        $total = $cartItems->sum(fn($item) => $item->subtotal());

        return view('checkout', compact('cartItems', 'total'));
    }

    /**
     * Place the order: save order + items, decrement stock, clear cart.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:100',
            'phone'   => 'required|string|max:20',
            'address' => 'required|string|max:255',
        ]);

        $cartItems = Cart::with('product')
            ->where('user_id', Auth::id())
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')
                ->with('error', 'Your cart is empty!');
        }

        $total = $cartItems->sum(fn($item) => $item->subtotal());

        // Wrap in a DB transaction so everything or nothing is saved
        $order = DB::transaction(function () use ($request, $cartItems, $total) {

            // Create the order
            $order = Order::create([
                'user_id'     => Auth::id(),
                'total_price' => $total,
                'status'      => 'pending',
                'address'     => $request->address . ', ' . $request->name . ', Ph: ' . $request->phone,
                'phone'       => $request->phone,
            ]);

            // Create each order item and decrement product stock
            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id'   => $order->id,
                    'product_id' => $item->product_id,
                    'quantity'   => $item->quantity,
                    'price'      => $item->product->price,
                ]);

                // Reduce stock
                $item->product->decrement('stock', $item->quantity);
            }

            // Clear the cart
            Cart::where('user_id', Auth::id())->delete();

            return $order;
        });

        return redirect()->route('orders.show', $order->id)
            ->with('success', 'Order placed successfully! 🎉');
    }

    /**
     * List all orders for the logged-in user.
     */
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('orders.index', compact('orders'));
    }

    /**
     * Show a single order detail.
     */
    public function show(Order $order)
    {
        // Make sure the order belongs to this user (or they're admin)
        if ($order->user_id !== Auth::id() && !Auth::user()->isAdmin()) {
            abort(403);
        }

        $order->load('orderItems.product');

        return view('orders.show', compact('order'));
    }
}
