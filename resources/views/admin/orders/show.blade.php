@extends('layouts.admin')

@section('header', 'Order Process Intelligence')

@section('content')
<div class="max-w-4xl mx-auto space-y-8 italic">

    <div class="flex justify-between items-end border-b border-[#f59e0b] pb-4">
        <div>
            <h2 class="text-3xl font-black italic">Order #CAR-{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</h2>
            <p class="text-xs text-gray-500 uppercase tracking-widest mt-1">Status management system</p>
        </div>
        <div class="text-right">
            <p class="text-sm font-bold text-gray-900">{{ $order->created_at->format('d M Y, H:i') }}</p>
            <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase {{ $order->statusColor() }}">
                Current Status: {{ $order->status }}
            </span>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        {{-- Customer Info --}}
        <div class="md:col-span-2 space-y-8">
            <div class="bg-white p-8 rounded-xl shadow-lg border-l-8 border-amber-500">
                <h3 class="text-xs font-black text-gray-400 uppercase tracking-widest mb-6">Dispatch Details</h3>
                <div class="grid grid-cols-2 gap-8">
                    <div>
                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Customer</p>
                        <p class="font-bold text-gray-900 text-lg">{{ $order->user->name }}</p>
                        <p class="text-sm text-gray-500">{{ $order->user->email }}</p>
                    </div>
                    <div>
                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Contact</p>
                        <p class="font-bold text-gray-900 text-lg">{{ $order->phone }}</p>
                    </div>
                    <div class="col-span-2">
                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Address</p>
                        <p class="text-gray-800 font-semibold text-lg italic leading-relaxed whitespace-pre-line">{{ $order->address }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <table class="w-full">
                    <thead class="bg-gray-50 text-[10px] font-black text-gray-400 uppercase tracking-widest text-left">
                        <tr>
                            <th class="px-6 py-4">Sku / Item Name</th>
                            <th class="px-6 py-4 text-center">Qty</th>
                            <th class="px-6 py-4 text-right">Unit Total</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @foreach($order->orderItems as $item)
                            <tr>
                                <td class="px-6 py-4">
                                    <p class="font-bold text-gray-900 italic underline decoration-amber-100">{{ $item->product->name }}</p>
                                    <p class="text-[9px] text-gray-400 uppercase">PARTS-{{ $item->product_id }}</p>
                                </td>
                                <td class="px-6 py-4 text-center font-black">{{ $item->quantity }}</td>
                                <td class="px-6 py-4 text-right font-black">Rs. {{ number_format($item->subtotal()) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="bg-[#0f172a] text-white">
                        <tr>
                            <td colspan="2" class="px-6 py-4 text-right font-black uppercase text-xs">Total Revenue</td>
                            <td class="px-6 py-4 text-right text-xl font-black text-[#f59e0b]">Rs. {{ number_format($order->total_price) }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        {{-- Status Control --}}
        <div class="space-y-6">
            <div class="bg-white p-6 rounded-xl shadow-lg border-t-8 border-navy italic">
                <h3 class="text-xs font-black text-gray-400 uppercase tracking-widest mb-6 underline decoration-amber-500">Update Status</h3>
                <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="space-y-4">
                        @foreach(\App\Models\Order::STATUSES as $status)
                            <label class="flex items-center gap-3 p-3 rounded-lg border cursor-pointer hover:bg-gray-50 transition @if($order->status == $status) border-amber-500 bg-amber-50 @endif">
                                <input type="radio" name="status" value="{{ $status }}" @if($order->status == $status) checked @endif class="text-amber-500 focus:ring-amber-500">
                                <span class="text-xs font-black uppercase tracking-widest {{ $order->status == $status ? 'text-amber-700' : 'text-gray-600' }}">
                                    {{ $status }}
                                </span>
                            </label>
                        @endforeach
                        <button type="submit" class="w-full bg-[#0f172a] hover:bg-slate-800 text-white py-3 rounded-lg font-black tracking-widest uppercase transition shadow-md mt-4">
                            UPDATE ORDER
                        </button>
                    </div>
                </form>
            </div>

            <div class="text-center p-4">
                <p class="text-[10px] text-gray-400 uppercase tracking-widest italic">Order fulfillment protocol v1.0</p>
            </div>
        </div>
    </div>

</div>
@endsection
