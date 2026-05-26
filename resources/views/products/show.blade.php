@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-12">
    <div class="flex flex-col lg:flex-row gap-12">

        {{-- Product Image --}}
        <div class="lg:w-1/2">
            <div class="aspect-square bg-white border border-gray-100 rounded-2xl overflow-hidden shadow-sm">
                <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
            </div>
        </div>

        {{-- Product Info --}}
        <div class="lg:w-1/2">
            <nav class="flex text-sm text-gray-500 mb-4">
                <a href="{{ route('home') }}" class="hover:text-[#f59e0b]">Home</a>
                <span class="mx-2">/</span>
                <a href="{{ route('products.index', ['category' => $product->category->slug]) }}" class="hover:text-[#f59e0b]">{{ $product->category->name }}</a>
                <span class="mx-2">/</span>
                <span class="text-gray-800">{{ $product->name }}</span>
            </nav>

            <h1 class="text-4xl font-bold text-gray-900 mb-4">{{ $product->name }}</h1>

            <div class="flex items-center gap-4 mb-6">
                <span class="text-3xl font-black text-[#f59e0b]">Rs. {{ number_format($product->price) }}</span>
                <span class="px-2.5 py-0.5 rounded-full text-xs font-bold uppercase tracking-wider {{ $product->stockColor() }}">
                    {{ $product->stockStatus() }} ({{ $product->stock }} left)
                </span>
            </div>

            <div class="prose prose-sm text-gray-600 mb-8 italic">
                <p>{{ $product->description }}</p>
            </div>

            <form action="{{ route('cart.store', $product->id) }}" method="POST">
                @csrf
                <div class="flex items-center gap-4 mb-6">
                    <div class="flex items-center border rounded-lg">
                        <label class="sr-only">Quantity</label>
                        <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}"
                               class="w-16 h-12 text-center border-none focus:ring-0 rounded-lg">
                    </div>
                    <button type="submit" @if($product->stock <= 0) disabled @endif
                            class="flex-1 bg-[#0f172a] hover:bg-slate-800 text-white h-12 rounded-lg font-bold flex items-center justify-center gap-2 transition disabled:opacity-50">
                        🛒 Add to Cart
                    </button>
                </div>
            </form>

            <div class="border-t pt-6 text-gray-600 text-sm space-y-2 italic">
                <p>SKU: <strong>PARTS-{{ str_pad($product->id, 5, '0', STR_PAD_LEFT) }}</strong></p>
                <p>Category: <a href="{{ route('products.index', ['category' => $product->category->slug]) }}" class="text-[#f59e0b] font-semibold">{{ $product->category->name }}</a></p>
            </div>
        </div>

    </div>
</div>
@endsection
