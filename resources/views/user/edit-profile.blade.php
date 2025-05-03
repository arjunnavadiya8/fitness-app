@extends('layouts.user')

@section('title', 'Edit Profile')

@section('content')
    <div class="container mt-5">
        <div class="card shadow-lg">
            <div class="card-body">
                <h2 class="text-center mb-4">Edit Profile</h2>
                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Full Name -->
                    <x-form-field
                        type="text"
                        name="username"
                        label="Full Name"
                        :value="auth()->user()->username"
                    />

                    <!-- Email -->
                    <x-form-field
                        type="email"
                        name="email"
                        label="Email"
                        :value="auth()->user()->email"
                    />

                    <!-- Height -->
                    <x-form-field
                        type="number"
                        name="height"
                        label="Height (cm)"
                        :value="auth()->user()->height"
                    />

                    <!-- Weight -->
                    <x-form-field
                        type="number"
                        name="weight"
                        label="Weight (kg)"
                        :value="auth()->user()->weight"
                    />

                    <!-- Age -->
                    <x-form-field
                        type="number"
                        name="age"
                        label="Age"
                        :value="auth()->user()->age"
                    />

                    <!-- Gender -->
                    <x-form-field
                        type="select"
                        name="gender"
                        label="Gender"
                        :value="auth()->user()->gender"
                        :options="['male' => 'Male', 'female' => 'Female', 'other' => 'Other']"
                    />

                    <!-- Profile Photo -->
                    <x-form-field
                        type="file"
                        enctype="multipart/form-type"
                        name="profile_photo"
                        label="Profile Photo"
                    />

                    <!-- Submit Button -->
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Update Profile</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
