@extends('layouts.admin')

@section('header', 'Dashboard Overview')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    {{-- Stats Cards --}}
    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 italic transition transform hover:scale-105">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Total Products</p>
                <h3 class="text-3xl font-black text-gray-900">{{ number_format($totalProducts) }}</h3>
            </div>
            <div class="w-12 h-12 bg-amber-100 text-[#f59e0b] rounded-full flex items-center justify-center text-xl">📦</div>
        </div>
    </div>

    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 italic transition transform hover:scale-105">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Total Orders</p>
                <h3 class="text-3xl font-black text-gray-900">{{ number_format($totalOrders) }}</h3>
            </div>
            <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center text-xl">📋</div>
        </div>
    </div>

    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 italic transition transform hover:scale-105">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Revenue</p>
                <h3 class="text-3xl font-black text-gray-900">Rs. {{ number_format($totalRevenue) }}</h3>
            </div>
            <div class="w-12 h-12 bg-green-100 text-green-600 rounded-full flex items-center justify-center text-xl">💰</div>
        </div>
    </div>

    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 italic transition transform hover:scale-105">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Customers</p>
                <h3 class="text-3xl font-black text-gray-900">{{ number_format($totalUsers) }}</h3>
            </div>
            <div class="w-12 h-12 bg-purple-100 text-purple-600 rounded-full flex items-center justify-center text-xl">👤</div>
        </div>
    </div>
</div>

{{-- Recent Orders Table --}}
<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="p-6 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
        <h3 class="font-black text-gray-900 italic underline decoration-amber-500">Recent Orders</h3>
        <a href="{{ route('admin.orders.index') }}" class="text-xs font-bold text-[#f59e0b] hover:underline uppercase tracking-widest">View All</a>
    </div>
    <table class="w-full">
        <thead class="bg-gray-50/50 text-[10px] font-black text-gray-400 uppercase tracking-widest text-left">
            <tr>
                <th class="px-6 py-4">Order ID</th>
                <th class="px-6 py-4">Customer</th>
                <th class="px-6 py-4">Total</th>
                <th class="px-6 py-4">Status</th>
                <th class="px-6 py-4">Date</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-50 italic">
            @foreach($recentOrders as $order)
                <tr>
                    <td class="px-6 py-4 font-bold text-sm">#CAR-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</td>
                    <td class="px-6 py-4 text-sm">{{ $order->user->name }}</td>
                    <td class="px-6 py-4 font-bold text-sm">Rs. {{ number_format($order->total_price) }}</td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-0.5 rounded-full text-[9px] font-black uppercase tracking-tighter {{ $order->statusColor() }}">
                            {{ $order->status }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-xs text-gray-500">{{ $order->created_at->diffForHumans() }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
