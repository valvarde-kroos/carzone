<!-- NAVBAR -->
    <nav class="navbar">
        <div class="logo"> <a href="/" style="text-decoration: none; color: black;font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif">Laravel</a></div>

        <div class="nav-links">
            <a href="/">Home</a>
            <a href="{{ route('carPost') }}">Car Post</a>
            <a href="{{ route('categoryPage') }}">Team Category</a>
            <a href="{{route('players.create')}}">Players</a>
            <a href="{{ route('contact') }}">Contact</a>
        </div>

        @auth
            <div class="nav-auth">
                <a href="{{ route('profile') }}" class="profile-link">Profile</a>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="logout-btn">Logout</button>
                </form>
            </div>
        @endauth

        @guest
            <div class="nav-actions">
                <a href="{{ route('loginForm') }}" class="login-btn">Login</a>
                <a href="{{ route('signupForm') }}" class="signup-btn">Sign Up</a>
            </div>
        @endguest

    </nav>
