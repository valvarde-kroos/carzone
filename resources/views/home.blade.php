@extends('layouts.app')

@section('content')
{{-- Hero Section --}}
<div class="bg-[#0f172a] text-white py-20 px-4">
    <div class="max-w-7xl mx-auto text-center">
        <h1 class="text-5xl font-extrabold mb-4 tracking-tight">Rev Up Your Drive</h1>
        <p class="text-xl text-gray-300 mb-8 max-w-2xl mx-auto">Premium car parts and accessories for every make and model. Quality you can trust.</p>
        <a href="{{ route('products.index') }}" class="inline-block bg-[#f59e0b] hover:bg-yellow-500 text-white font-bold py-3 px-8 rounded-lg transition transform hover:scale-105">
            Shop All Parts
        </a>
    </div>
</div>

{{-- Featured Products Grid --}}
<div class="max-w-7xl mx-auto px-4 py-16">
    <div class="flex justify-between items-end mb-10">
        <div>
            <h2 class="text-3xl font-bold text-gray-900 italic underline decoration-[#f59e0b]">Featured Parts</h2>
            <p class="text-gray-600 mt-2">Latest additions to our inventory.</p>
        </div>
        <a href="{{ route('products.index') }}" class="text-[#f59e0b] font-semibold hover:underline">View All →</a>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($featuredProducts as $product)
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden group hover:shadow-md transition">
                <a href="{{ route('products.show', $product->slug) }}">
                    <div class="h-64 bg-gray-200 overflow-hidden">
                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-full object-cover transition transform group-hover:scale-110">
                    </div>
                </a>
                <div class="p-6">
                    <p class="text-xs text-[#f59e0b] font-bold uppercase tracking-wider mb-1">{{ $product->category->name }}</p>
                    <a href="{{ route('products.show', $product->slug) }}">
                        <h3 class="text-xl font-bold text-gray-900 group-hover:text-[#0f172a] transition mb-2">{{ $product->name }}</h3>
                    </a>
                    <p class="text-gray-600 text-sm mb-4 line-clamp-2 italic">{{ $product->description }}</p>
                    <div class="flex justify-between items-center">
                        <span class="text-2xl font-bold text-gray-900">Rs. {{ number_format($product->price) }}</span>
                        <a href="{{ route('products.show', $product->slug) }}" class="bg-[#0f172a] text-white px-4 py-2 rounded text-sm font-medium hover:bg-slate-800 transition">View Details</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
