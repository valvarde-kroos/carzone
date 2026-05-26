@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-12">
    <div class="flex items-center justify-between mb-8">
        <h1 class="text-3xl font-bold italic underline decoration-[#f59e0b]">My Orders</h1>
    </div>

    @if($orders->isEmpty())
        <div class="bg-white rounded-2xl shadow-sm p-12 text-center border border-dashed border-gray-200">
            <p class="text-gray-500 mb-6 italic text-lg">You haven't placed any orders yet.</p>
            <a href="{{ route('products.index') }}" class="bg-[#f59e0b] text-white px-8 py-3 rounded-lg font-bold hover:bg-yellow-600 transition">
                Browse Parts
            </a>
        </div>
    @else
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <table class="w-full">
                <thead class="bg-gray-50 text-xs font-bold text-gray-500 uppercase tracking-widest text-left">
                    <tr>
                        <th class="px-6 py-4">Order ID</th>
                        <th class="px-6 py-4">Date</th>
                        <th class="px-6 py-4">Total Amount</th>
                        <th class="px-6 py-4 text-center">Status</th>
                        <th class="px-6 py-4"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 italic">
                    @foreach($orders as $order)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 font-bold text-gray-900">
                                #CAR-{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}
                            </td>
                            <td class="px-6 py-4 text-gray-600 text-sm">
                                {{ $order->created_at->format('M d, Y') }}
                            </td>
                            <td class="px-6 py-4 font-bold">
                                Rs. {{ number_format($order->total_price) }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-widest {{ $order->statusColor() }}">
                                    {{ $order->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('orders.show', $order->id) }}" class="text-[#f59e0b] font-bold text-sm hover:underline">
                                    View Details
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
