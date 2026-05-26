<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard – CarZone</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans">

<div class="flex h-screen">
    {{-- Sidebar --}}
    <aside class="w-64 bg-[#0f172a] text-white">
        <div class="p-6 text-2xl font-bold text-[#f59e0b]">
            CarZone Admin
        </div>
        <nav class="mt-6">
            <a href="{{ route('admin.dashboard') }}" class="block px-6 py-3 hover:bg-gray-800 @if(Route::is('admin.dashboard')) bg-gray-800 border-l-4 border-[#f59e0b] @endif italic">Dashboard</a>
            <a href="{{ route('admin.products.index') }}" class="block px-6 py-3 hover:bg-gray-800 @if(Route::is('admin.products.*')) bg-gray-800 border-l-4 border-[#f59e0b] @endif italic">Products</a>
            <a href="{{ route('admin.categories.index') }}" class="block px-6 py-3 hover:bg-gray-800 @if(Route::is('admin.categories.*')) bg-gray-800 border-l-4 border-[#f59e0b] @endif italic">Categories</a>
            <a href="{{ route('admin.orders.index') }}" class="block px-6 py-3 hover:bg-gray-800 @if(Route::is('admin.orders.*')) bg-gray-800 border-l-4 border-[#f59e0b] @endif italic">Orders</a>
        </nav>
    </aside>

    {{-- Main Content --}}
    <main class="flex-1 overflow-y-auto">
        <header class="bg-white shadow px-8 py-4 flex justify-between items-center">
            <h1 class="text-xl font-semibold">@yield('header', 'Admin Panel')</h1>
            <div class="flex items-center gap-4">
                <span class="text-sm text-gray-600">{{ auth()->user()->name }}</span>
                <a href="{{ route('home') }}" class="text-sm text-[#f59e0b] hover:underline">View Store</a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="text-sm text-red-600 hover:underline">Logout</button>
                </form>
            </div>
        </header>

        <div class="p-8">
            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            @yield('content')
        </div>
    </main>
</div>

</body>
</html>
