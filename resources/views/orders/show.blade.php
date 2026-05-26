@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-12">
    <div class="mb-4">
        <a href="{{ route('orders.index') }}" class="text-sm text-[#f59e0b] font-bold hover:underline">← Back to My Orders</a>
    </div>

    <div class="flex justify-between items-end mb-8 border-b border-[#f59e0b] pb-4">
        <div>
            <h1 class="text-3xl font-black italic">Order #CAR-{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</h1>
            <p class="text-gray-500 text-sm mt-1">Placed on {{ $order->created_at->format('F d, Y at h:i A') }}</p>
        </div>
        <span class="px-4 py-1.5 rounded-full text-xs font-black uppercase tracking-widest {{ $order->statusColor() }}">
            {{ $order->status }}
        </span>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
        {{-- Shipping Info --}}
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
            <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4">Delivery Address</h3>
            <p class="text-gray-800 italic whitespace-pre-line">{{ $order->address }}</p>
            <p class="mt-4 text-sm text-gray-500 italic">📞 {{ $order->phone }}</p>
        </div>

        {{-- Order Notes/Status --}}
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
            <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4">Payment Method</h3>
            <div class="flex items-center gap-3">
                <span class="text-2xl">💵</span>
                <div>
                    <p class="font-bold text-gray-900 italic">Cash on Delivery</p>
                    <p class="text-xs text-gray-500 italic">Pay when you receive the parts.</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Order Items --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden mb-8">
        <table class="w-full">
            <thead class="bg-gray-50 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] text-left">
                <tr>
                    <th class="px-6 py-4">Part / Accessory</th>
                    <th class="px-6 py-4 text-center">Price</th>
                    <th class="px-6 py-4 text-center">Qty</th>
                    <th class="px-6 py-4 text-right">Subtotal</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach($order->orderItems as $item)
                    <tr class="italic">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-gray-100 rounded overflow-hidden">
                                    <img src="{{ $item->product->image_url }}" class="w-full h-full object-cover">
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-900 underline decoration-amber-100">{{ $item->product->name }}</h4>
                                    <p class="text-[10px] text-gray-400">{{ $item->product->category->name }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-center text-gray-500 text-sm">
                            Rs. {{ number_format($item->price) }}
                        </td>
                        <td class="px-6 py-4 text-center font-bold">
                            {{ $item->quantity }}
                        </td>
                        <td class="px-6 py-4 text-right font-black">
                            Rs. {{ number_format($item->subtotal()) }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot class="bg-[#0f172a] text-white">
                <tr>
                    <td colspan="3" class="px-6 py-4 text-right font-bold uppercase tracking-widest text-xs">Grand Total</td>
                    <td class="px-6 py-4 text-right text-xl font-black text-[#f59e0b]">Rs. {{ number_format($order->total_price) }}</td>
                </tr>
            </tfoot>
        </table>
    </div>

    <div class="text-center">
        <p class="text-sm text-gray-500 italic">Need help with this order? <a href="{{ route('contact') }}" class="text-[#f59e0b] font-bold">Contact Support</a></p>
    </div>
</div>
@endsection
