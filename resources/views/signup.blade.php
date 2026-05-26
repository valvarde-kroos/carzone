@extends('layout.main')
@section('hyasabicontentauncha')

<div class="signup-wrapper">
    <div class="signup-card">

        <!-- LEFT SECTION -->
        <div class="signup-left">
            <h1>Welcome!</h1>
            <p>
                Create your account and start your journey with us.
                Join today to explore more features.
            </p>
        </div>

        <!-- RIGHT SECTION -->
        <div class="signup-right">
            <h2>Create Account</h2>

            <form method="POST" action="{{ route('register') }}">
                {{-- Cross Site Request Forgey Attack   gives token   --}}
                @csrf
                <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" name="name" placeholder="Enter your name" value="{{ old('name') }}">
                    @error('name')
                        <p style="color: red">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Email Address</label>
                    <input type="text" name="email" placeholder="Enter email" value="{{ old('email') }}">
                    @error('email')
                        <p style="color: red">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password"  placeholder="Enter password">
                    @error('password')
                        <p style="color: red">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" name="password_confirmation"  placeholder="Confirm password">
                </div>

                <button type="submit" class="signup-submit">
                    Sign Up
                </button>
            </form>
            <p>Already have an account? <a href="">Login</a> </p>
        </div>

    </div>
</div>

@endsection
