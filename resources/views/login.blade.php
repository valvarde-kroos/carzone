@extends('layout.main')
@section('hyasabicontentauncha')

<div class="signup-wrapper">
    <div class="signup-card">

        <!-- LEFT SECTION -->
        <div class="signup-left">
            <h1>Welcome Back!</h1>
            <p>
                Hey! Good to see you again.
            </p>
        </div>



        <!-- RIGHT SECTION -->
        <div class="signup-right">
            <h2>Login</h2>
            @if (session('error'))
                <p style="color: red">{{ session('error') }}</p>
            @endif
            @if (session('success'))
                <p style="color: green; text-align: center; font-size: 30px;">{{ session('success') }}</p>
            @endif
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Email Address</label>
                    <input type="text" name="email" placeholder="Enter email" >
                    @error('email')
                        <p style="color: red">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Enter password">
                    @error('password')
                        <p style="color: red">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="signup-submit">
                    Login
                </button>
            </form>
            <p>Don't have an account? <a href="">Sign Up</a> </p>
        </div>

    </div>
</div>

@endsection
