@extends('layouts.user')

@section('title', 'Register')

@section('content')
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="col-md-6">
            <div class="card shadow-lg">
                <div class="card-header bg-white text-center">
                    <h3 class="text-success">Register</h3>
                </div>
                <div class="card-body">
                    <x-form action="{{ route('register') }}" method="POST" submitText="Register">
                        <!-- Name Field -->
                        <x-form-field
                            label="Name"
                            name="name"
                            type="text"
                            :value="old('name')"
                        />

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

                        <!-- Confirm Password Field -->
                        <x-form-field
                            label="Confirm Password"
                            name="password_confirmation"
                            type="password"
                        />

                        <!-- Role Field -->
                        <x-form-field
                            label="Role"
                            name="role"
                            type="select"
                            :value="old('role')"
                            :options="['user' => 'User', 'admin' => 'Admin']"
                        />
                    </x-form>
                </div>
                <div class="card-footer text-center">
                    <a href="{{ route('login') }}" class="text-decoration-none text-success">Already have an account? Login</a>
                </div>
            </div>
        </div>
    </div>
@endsection
