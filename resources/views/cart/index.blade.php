@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-12">
    <h1 class="text-3xl font-bold mb-8 italic underline decoration-[#f59e0b]">Shopping Cart</h1>

    @if($cartItems->isEmpty())
        <div class="bg-white rounded-2xl shadow-sm p-12 text-center border border-dashed border-gray-200">
            <p class="text-gray-500 mb-6 italic text-lg">Your cart is feeling light...</p>
            <a href="{{ route('products.index') }}" class="bg-[#f59e0b] text-white px-8 py-3 rounded-lg font-bold hover:bg-yellow-600 transition">
                Start Shopping
            </a>
        </div>
    @else
        <div class="flex flex-col lg:flex-row gap-8">
            {{-- Cart Items --}}
            <div class="flex-1">
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <table class="w-full">
                        <thead class="bg-gray-50 text-xs font-bold text-gray-500 uppercase tracking-widest text-left">
                            <tr>
                                <th class="px-6 py-4">Product</th>
                                <th class="px-6 py-4 text-center">Unit Price</th>
                                <th class="px-6 py-4 text-center">Quantity</th>
                                <th class="px-6 py-4 text-right">Subtotal</th>
                                <th class="px-6 py-4"></th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach($cartItems as $item)
                                <tr>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-4">
                                            <div class="w-16 h-16 bg-gray-100 rounded overflow-hidden flex-shrink-0">
                                                <img src="{{ $item->product->image_url }}" alt="{{ $item->product->name }}" class="w-full h-full object-cover">
                                            </div>
                                            <div>
                                                <h4 class="font-bold text-gray-900 italic underline decoration-amber-100">{{ $item->product->name }}</h4>
                                                <p class="text-xs text-gray-500">{{ $item->product->category->name }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-center text-gray-600">
                                        Rs. {{ number_format($item->product->price) }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <form action="{{ route('cart.update', $item->id) }}" method="POST" class="flex items-center justify-center gap-2">
                                            @csrf
                                            @method('PATCH')
                                            <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" max="{{ $item->product->stock }}"
                                                   class="w-16 text-sm border-gray-200 rounded px-2 py-1 text-center" onchange="this.form.submit()">
                                        </form>
                                    </td>
                                    <td class="px-6 py-4 text-right font-bold">
                                        Rs. {{ number_format($item->subtotal()) }}
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <form action="{{ route('cart.destroy', $item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="text-red-400 hover:text-red-600 transition">✕</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Summary --}}
            <aside class="w-full lg:w-96">
                <div class="bg-[#0f172a] text-white rounded-xl shadow-lg p-6 sticky top-8">
                    <h2 class="text-xl font-bold mb-6 italic underline decoration-[#f59e0b]">Order Summary</h2>
                    <div class="flex justify-between mb-4 text-gray-400">
                        <span>Items Total</span>
                        <span class="text-white font-medium">Rs. {{ number_format($total) }}</span>
                    </div>
                    <div class="flex justify-between mb-8 border-t border-slate-700 pt-4 font-bold text-lg">
                        <span>Grand Total</span>
                        <span class="text-[#f59e0b]">Rs. {{ number_format($total) }}</span>
                    </div>
                    <a href="{{ route('checkout') }}" class="block w-full bg-[#f59e0b] hover:bg-yellow-500 text-white py-3 rounded-lg font-bold text-center transition">
                        Proceed to Checkout
                    </a>
                    <p class="text-center text-xs text-slate-500 mt-4 italic">Free standard shipping on all orders.</p>
                </div>
            </aside>
        </div>
    @endif
</div>
@endsection
