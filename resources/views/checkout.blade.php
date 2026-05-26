@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-12">
    <h1 class="text-3xl font-bold mb-8 italic underline decoration-[#f59e0b]">Checkout</h1>

    <div class="flex flex-col lg:flex-row gap-12">
        {{-- Shipping Form --}}
        <div class="flex-1">
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8">
                <h2 class="text-xl font-bold mb-6 text-gray-900 italic">Shipping Information</h2>

                <form action="{{ route('checkout.store') }}" method="POST" id="checkout-form">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="form-group">
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-2">Recipient Name</label>
                            <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}" required
                                   class="w-full border-gray-200 rounded-lg focus:ring-[#f59e0b] focus:border-[#f59e0b]">
                        </div>
                        <div class="form-group">
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-2">Phone Number</label>
                            <input type="text" name="phone" value="{{ old('phone') }}" required placeholder="+977"
                                   class="w-full border-gray-200 rounded-lg focus:ring-[#f59e0b] focus:border-[#f59e0b]">
                        </div>
                        <div class="form-group md:col-span-2">
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-2">Delivery Address</label>
                            <textarea name="address" rows="3" required
                                      class="w-full border-gray-200 rounded-lg focus:ring-[#f59e0b] focus:border-[#f59e0b]"></textarea>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        {{-- Order Summary --}}
        <aside class="w-full lg:w-96">
            <div class="bg-[#0f172a] text-white rounded-xl shadow-lg p-6 sticky top-8">
                <h2 class="text-xl font-bold mb-6 italic underline decoration-[#f59e0b]">Review Items</h2>

                <div class="space-y-4 mb-6 max-h-60 overflow-y-auto pr-2 custom-scrollbar">
                    @foreach($cartItems as $item)
                        <div class="flex gap-4 items-center">
                            <div class="w-12 h-12 bg-gray-700 rounded overflow-hidden flex-shrink-0">
                                <img src="{{ $item->product->image_url }}" alt="{{ $item->product->name }}" class="w-full h-full object-cover">
                            </div>
                            <div class="flex-1 min-w-0">
                                <h4 class="text-sm font-bold truncate italic">{{ $item->product->name }}</h4>
                                <p class="text-xs text-gray-400">{{ $item->quantity }} x Rs. {{ number_format($item->product->price) }}</p>
                            </div>
                            <div class="text-sm font-bold text-[#f59e0b]">
                                Rs. {{ number_format($item->subtotal()) }}
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="border-t border-slate-700 pt-4 space-y-2 mb-6">
                    <div class="flex justify-between text-sm text-gray-400">
                        <span>Subtotal</span>
                        <span>Rs. {{ number_format($total) }}</span>
                    </div>
                    <div class="flex justify-between text-sm text-gray-400">
                        <span>Shipping</span>
                        <span class="text-green-400 italic">FREE</span>
                    </div>
                    <div class="flex justify-between pt-4 font-bold text-lg border-t border-slate-700">
                        <span>Total Pay</span>
                        <span class="text-[#f59e0b]">Rs. {{ number_format($total) }}</span>
                    </div>
                </div>

                <button type="submit" form="checkout-form" class="block w-full bg-[#f59e0b] hover:bg-yellow-500 text-white py-4 rounded-lg font-bold text-center transition shadow-xl">
                    PLACE ORDER NOW
                </button>
                <div class="mt-4 flex items-center justify-center gap-2 text-[10px] text-slate-500 uppercase tracking-widest">
                    <span>🔒 SECURE CHECKOUT</span>
                    <span>•</span>
                    <span>CASH ON DELIVERY</span>
                </div>
            </div>
        </aside>
    </div>
</div>
@endsection
