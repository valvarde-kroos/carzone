@extends('layouts.admin')

@section('header', 'Manage Categories')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8 italic">
    {{-- Add Category Form --}}
    <div class="lg:col-span-1">
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 italic sticky top-8">
            <h3 class="text-xl font-black mb-6 underline decoration-amber-500">New Category</h3>
            <form action="{{ route('admin.categories.store') }}" method="POST">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Category Name</label>
                        <input type="text" name="name" required class="w-full border-gray-200 rounded-lg font-bold">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Brief Description</label>
                        <textarea name="description" rows="3" class="w-full border-gray-200 rounded-lg text-sm"></textarea>
                    </div>
                    <button type="submit" class="w-full bg-amber-500 hover:bg-amber-600 text-white py-2 rounded-lg font-black tracking-widest uppercase transition">
                        CREATE CATEGORY
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Categories List --}}
    <div class="lg:col-span-2">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <table class="w-full">
                <thead class="bg-gray-50 text-[10px] font-black text-gray-400 uppercase tracking-widest text-left">
                    <tr>
                        <th class="px-6 py-4">Name</th>
                        <th class="px-6 py-4">Total Parts</th>
                        <th class="px-6 py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @foreach($categories as $cat)
                        <tr>
                            <td class="px-6 py-4 font-bold text-gray-900">
                                {{ $cat->name }}
                                <p class="text-[10px] text-gray-400 font-normal">/{{ $cat->slug }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <span class="bg-gray-100 px-3 py-1 rounded-full text-xs font-black">
                                    {{ $cat->products_count }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex justify-end gap-2">
                                    <form action="{{ route('admin.categories.destroy', $cat->id) }}" method="POST" onsubmit="return confirm('Delete category? All linked products will remain but will be uncategorized.')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-red-400 hover:text-red-600">🗑️</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
