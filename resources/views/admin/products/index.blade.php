@extends('layouts.admin')

@section('header', 'Manage Products')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-3xl font-black italic underline decoration-amber-500">Inventory</h2>
    <a href="{{ route('admin.products.create') }}" class="bg-[#f59e0b] hover:bg-yellow-600 text-white font-bold py-2 px-6 rounded-lg transition shadow-md">
        + Add New Product
    </a>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-50 text-[10px] font-black text-gray-400 uppercase tracking-widest text-left border-b border-gray-100">
            <tr>
                <th class="px-6 py-4">Part Details</th>
                <th class="px-6 py-4">Category</th>
                <th class="px-6 py-4">Price</th>
                <th class="px-6 py-4">Stock</th>
                <th class="px-6 py-4 text-right">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-50 italic">
            @foreach($products as $product)
                <tr class="hover:bg-gray-50/50 transition">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-gray-100 rounded overflow-hidden">
                                <img src="{{ $product->image_url }}" alt="" class="w-full h-full object-cover">
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900 underline decoration-amber-100">{{ $product->name }}</h4>
                                <p class="text-[10px] text-gray-400 uppercase tracking-widest">ID: #P-{{ $product->id }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-sm font-semibold text-gray-600">
                        {{ $product->category->name }}
                    </td>
                    <td class="px-6 py-4 font-black">
                        Rs. {{ number_format($product->price) }}
                    </td>
                    <td class="px-6 py-4">
                        <span class="inline-block px-2 py-0.5 rounded-full text-[10px] font-black uppercase tracking-widest {{ $product->stockColor() }}">
                            {{ $product->stock }} ({{ $product->stockStatus() }})
                        </span>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex justify-end gap-2">
                            <a href="{{ route('admin.products.edit', $product->id) }}" class="p-2 text-blue-500 hover:bg-blue-50 rounded transition">✏️</a>
                            <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Archive this part from inventory?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 text-red-500 hover:bg-red-50 rounded transition">🗑️</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="p-6 border-t border-gray-50">
        {{ $products->links() }}
    </div>
</div>
@endsection
