@extends('layouts.admin')

@section('header', 'Manage Orders')

@section('content')
<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden italic">
    <table class="w-full">
        <thead class="bg-gray-50 text-[10px] font-black text-gray-400 uppercase tracking-widest text-left">
            <tr>
                <th class="px-6 py-4">Order ID</th>
                <th class="px-6 py-4">Customer</th>
                <th class="px-6 py-4">Grand Total</th>
                <th class="px-6 py-4">Status</th>
                <th class="px-6 py-4">Date</th>
                <th class="px-6 py-4 text-right">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-50">
            @foreach($orders as $order)
                <tr class="hover:bg-gray-50/50 transition">
                    <td class="px-6 py-4 font-black">#CAR-{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</td>
                    <td class="px-6 py-4">
                        <div class="text-sm font-bold text-gray-900">{{ $order->user->name }}</div>
                        <div class="text-[10px] text-gray-500">{{ $order->user->email }}</div>
                    </td>
                    <td class="px-6 py-4 font-black text-amber-600">Rs. {{ number_format($order->total_price) }}</td>
                    <td class="px-6 py-4">
                        <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-tighter {{ $order->statusColor() }}">
                            {{ $order->status }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-xs text-gray-500">{{ $order->created_at->format('M d, Y') }}</td>
                    <td class="px-6 py-4 text-right">
                        <a href="{{ route('admin.orders.show', $order->id) }}" class="text-[#0f172a] font-black text-sm hover:underline">
                            MANAGE →
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="p-6">
        {{ $orders->links() }}
    </div>
</div>
@endsection
