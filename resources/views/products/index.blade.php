@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-12 flex gap-8">
    {{-- Sidebar Filters --}}
    <aside class="w-64 hidden md:block shrink-0">
        <h2 class="text-lg font-bold mb-4 border-b pb-2">Categories</h2>
        <ul class="space-y-2">
            <li>
                <a href="{{ route('products.index') }}" class="block px-3 py-2 rounded-md hover:bg-amber-50 @if(!request('category')) bg-amber-100 font-bold text-[#f59e0b] @endif">All Parts</a>
            </li>
            @foreach($categories as $cat)
                <li>
                    <a href="{{ route('products.index', ['category' => $cat->slug]) }}"
                       class="block px-3 py-2 rounded-md hover:bg-amber-50 @if(request('category') == $cat->slug) bg-amber-100 font-bold text-[#f59e0b] @endif">
                        {{ $cat->name }}
                    </a>
                </li>
            @endforeach
        </ul>
    </aside>

    {{-- Main Grid --}}
    <div class="flex-1">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold italic underline decoration-amber-500">
                @if(request('search')) Search results for "{{ request('search') }}"
                @elseif(request('category')) {{ $categories->where('slug', request('category'))->first()->name ?? 'Parts & Accessories' }}
                @else All Car Parts @endif
            </h1>
            <p class="text-sm text-gray-500 italic">{{ $products->total() }} items found</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($products as $product)
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden group hover:shadow-md transition">
                    <a href="{{ route('products.show', $product->slug) }}">
                        <div class="h-48 bg-gray-200 overflow-hidden">
                            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition">
                        </div>
                    </a>
                    <div class="p-4">
                        <span class="inline-block px-2 py-0.5 text-[10px] uppercase font-bold tracking-widest rounded-full {{ $product->stockColor() }} mb-2">
                            {{ $product->stockStatus() }}
                        </span>
                        <a href="{{ route('products.show', $product->slug) }}">
                            <h3 class="font-bold text-gray-900 group-hover:text-[#f59e0b] mb-1 line-clamp-1">{{ $product->name }}</h3>
                        </a>
                        <p class="text-xs text-gray-500 mb-3">{{ $product->category->name }}</p>
                        <div class="flex justify-between items-center">
                            <span class="text-lg font-black text-gray-900">Rs. {{ number_format($product->price) }}</span>
                            <form action="{{ route('cart.store', $product->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit" @if($product->stock <= 0) disabled @endif
                                        class="bg-[#f59e0b] text-white p-2 rounded hover:bg-yellow-600 disabled:opacity-50 disabled:cursor-not-allowed transition">
                                    🛒+
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-20 text-center text-gray-500 italic">
                    No products found Matching your criteria.
                </div>
            @endforelse
        </div>

        <div class="mt-12">
            {{ $products->links() }}
        </div>
    </div>
</div>
@endsection
