@extends('layouts.user')

@section('title', 'Login')

@section('content')
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="col-md-6">
            <div class="card shadow-lg">
                <div class="card-header bg-white text-center">
                    <h3 class="text-success">Login</h3>
                </div>
                <div class="card-body">
                    <x-form action="{{ route('login') }}" method="POST" submitText="Sign In">
                        <!-- Email Field -->
                        <x-form-field
                            label="Email"
                            name="email"
                            type="email"
                            :value="old('email')"
                        />

                        <!-- Password Field -->
                        <x-form-field
                            label="Password"
                            name="password"
                            type="password"
                        />

                        <!-- Show Password Checkbox -->
                        <div class="form-check mt-3">
                            <input type="checkbox" class="form-check-input" id="showPassword" onclick="togglePassword()">
                            <label class="form-check-label" for="showPassword">Show Password</label>
                        </div>
                    </x-form>
                </div>
                <div class="card-footer text-center">
                    <a href="{{ route('password.request') }}" class="text-decoration-none text-muted">Forgot Username / Password?</a>
                    <br>
                    <a href="{{ route('register') }}" class="text-decoration-none text-success">Don't have an account? Sign up</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordField = document.querySelector('input[name="password"]');
            passwordField.type = passwordField.type === 'password' ? 'text' : 'password';
        }
    </script>
@endsection
