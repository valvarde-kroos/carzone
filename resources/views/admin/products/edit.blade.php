@extends('layouts.admin')

@section('header', 'Update Inventory Entry')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-6">
        <a href="{{ route('admin.products.index') }}" class="text-sm font-bold text-gray-500 hover:text-amber-500 transition">← Back to Inventory</a>
    </div>

    <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-8 italic">
        <h2 class="text-2xl font-black mb-8 underline decoration-amber-500">Edit Product: {{ $product->name }}</h2>

        <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 gap-6">
                {{-- Part Name --}}
                <div class="form-group">
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2">Part Name</label>
                    <input type="text" name="name" value="{{ old('name', $product->name) }}" required
                           class="w-full border-gray-200 rounded-lg focus:ring-[#f59e0b] focus:border-[#f59e0b] font-bold">
                </div>

                <div class="grid grid-cols-2 gap-6">
                    {{-- Category --}}
                    <div class="form-group">
                        <label class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2">Category</label>
                        <select name="category_id" required
                                class="w-full border-gray-200 rounded-lg focus:ring-[#f59e0b] focus:border-[#f59e0b] font-bold">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Price --}}
                    <div class="form-group">
                        <label class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2">Unit Price (Rs.)</label>
                        <input type="number" name="price" value="{{ old('price', $product->price) }}" required
                               class="w-full border-gray-200 rounded-lg focus:ring-[#f59e0b] focus:border-[#f59e0b] font-bold">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-6">
                    {{-- Stock --}}
                    <div class="form-group">
                        <label class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2">Stock Level</label>
                        <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" required
                               class="w-full border-gray-200 rounded-lg focus:ring-[#f59e0b] focus:border-[#f59e0b] font-bold">
                    </div>

                    {{-- Image --}}
                    <div class="form-group">
                        <label class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2">Replace Image (Optional)</label>
                        <input type="file" name="image"
                               class="w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-black file:bg-amber-50 file:text-[#f59e0b] hover:file:bg-amber-100 transition">
                        @if($product->image)
                            <p class="mt-2 text-[10px] text-gray-400 italic">Current image exists in storage.</p>
                        @endif
                    </div>
                </div>

                {{-- Description --}}
                <div class="form-group">
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2">Description / Specifications</label>
                    <textarea name="description" rows="4" required
                              class="w-full border-gray-200 rounded-lg focus:ring-[#f59e0b] focus:border-[#f59e0b] font-medium">{{ old('description', $product->description) }}</textarea>
                </div>

                <div class="pt-4">
                    <button type="submit" class="w-full bg-[#0f172a] hover:bg-slate-800 text-white py-4 rounded-xl font-black tracking-widest uppercase shadow-lg transition transform hover:-translate-y-1">
                        UPDATE INVENTORY DATA
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
