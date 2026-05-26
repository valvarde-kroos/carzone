<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CarZone – @yield('title', 'Car Parts & Accessories')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root {
            --navy: #0f172a;
            --amber: #f59e0b;
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 font-sans">

<nav class="bg-[#0f172a] text-white shadow-lg">
    <div class="max-w-7xl mx-auto px-4 py-3 flex items-center justify-between gap-4">
        <a href="{{ route('home') }}" class="text-2xl font-bold text-[#f59e0b] tracking-wide flex items-center gap-2">
            🚗 CarZone
        </a>

        <form action="{{ route('products.index') }}" method="GET" class="flex-1 max-w-md hidden sm:flex">
            <input type="text" name="search" value="{{ request('search') }}"
                placeholder="Search car parts..."
                class="w-full rounded-l-lg px-4 py-2 text-gray-800 text-sm focus:outline-none">
            <button type="submit" class="bg-[#f59e0b] hover:bg-yellow-500 text-white px-4 rounded-r-lg text-sm font-medium">
                Search
            </button>
        </form>

        <div class="flex items-center gap-4 text-sm">
            <a href="{{ route('products.index') }}" class="hover:text-[#f59e0b] transition">Shop</a>

            @auth
                @php $cartCount = \App\Models\Cart::where('user_id', auth()->id())->sum('quantity'); @endphp
                <a href="{{ route('cart.index') }}" class="relative hover:text-[#f59e0b] transition">
                    🛒
                    @if($cartCount > 0)
                        <span class="absolute -top-2 -right-2 bg-[#f59e0b] text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">
                            {{ $cartCount }}
                        </span>
                    @endif
                </a>

                <div class="relative group">
                    <button class="hover:text-[#f59e0b] transition">{{ auth()->user()->name }} ▾</button>
                    <div class="absolute right-0 mt-2 w-40 bg-white text-gray-800 rounded shadow-lg z-50 hidden group-hover:block">
                        <a href="{{ route('orders.index') }}" class="block px-4 py-2 hover:bg-gray-100 text-sm">My Orders</a>
                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 hover:bg-gray-100 text-sm text-amber-600 font-semibold">Admin Panel</a>
                        @endif
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="w-full text-left px-4 py-2 hover:bg-gray-100 text-sm text-red-600">Logout</button>
                        </form>
                    </div>
                </div>
            @else
                <a href="{{ route('loginForm') }}" class="hover:text-[#f59e0b] transition">Login</a>
                <a href="{{ route('signupForm') }}" class="bg-[#f59e0b] hover:bg-yellow-500 text-white px-3 py-1 rounded font-medium transition">Register</a>
            @endauth
        </div>
    </div>
</nav>

@if(session('success'))
    <div class="bg-green-100 border-l-4 border-green-500 text-green-800 px-4 py-3 text-sm">
        ✅ {{ session('success') }}
    </div>
@endif
@if(session('error'))
    <div class="bg-red-100 border-l-4 border-red-500 text-red-800 px-4 py-3 text-sm">
        ❌ {{ session('error') }}
    </div>
@endif

<main>
    @yield('content')
</main>

<footer class="bg-[#0f172a] text-gray-400 mt-16 py-10">
    <div class="max-w-7xl mx-auto px-4 grid grid-cols-1 sm:grid-cols-3 gap-8">
        <div>
            <h3 class="text-[#f59e0b] font-bold text-lg mb-2">🚗 CarZone</h3>
            <p class="text-sm">Your trusted source for quality car parts and accessories.</p>
        </div>
        <div>
            <h4 class="text-white font-semibold mb-2">Quick Links</h4>
            <ul class="space-y-1 text-sm">
                <li><a href="{{ route('home') }}" class="hover:text-[#f59e0b]">Home</a></li>
                <li><a href="{{ route('products.index') }}" class="hover:text-[#f59e0b]">Shop</a></li>
                <li><a href="{{ route('contact') }}" class="hover:text-[#f59e0b]">Contact</a></li>
            </ul>
        </div>
        <div>
            <h4 class="text-white font-semibold mb-2">Contact</h4>
            <p class="text-sm">📞 +977 9800000000</p>
            <p class="text-sm">📧 info@carzone.com</p>
            <p class="text-sm">📍 Kathmandu, Nepal</p>
        </div>
    </div>
    <div class="text-center text-xs mt-8 text-gray-600">
        © {{ date('Y') }} CarZone. All rights reserved.
    </div>
</footer>

</body>
</html>
