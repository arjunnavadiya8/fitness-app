@extends('layouts.user')

@section('title', 'Profile')

@section('content')
    <div class="container mt-5">
        <div class="card shadow-lg">
            <div class="card-body">
                <!-- Header Section -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h2>Welcome, {{ auth()->user()->username }}!</h2>
                        <p class="text-muted">Joined on {{ auth()->user()->created_at->format('d M Y') }}</p>
                    </div>
                    <div>
                        <!-- Profile Photo -->
                        <img src="{{ auth()->user()->profile_photo_url ? asset('storage/' . auth()->user()->profile_photo_url) : asset('image/default-profile.png') }}"
                        alt="Profile Photo"
                        class="rounded-circle"
                        style="width: 50px; height: 50px; object-fit: cover; border: 5px solid #ddd;">
                    </div>
                </div>

                <!-- Profile Details -->
                <div class="row">
                    <!-- Left Column -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label"><strong>Full Name</strong></label>
                            <p class="form-control">{{ auth()->user()->username }}</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label"><strong>Email</strong></label>
                            <p class="form-control">{{ auth()->user()->email }}</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label"><strong>Height</strong></label>
                            <p class="form-control">{{ auth()->user()->height }} cm</p>
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label"><strong>Weight</strong></label>
                            <p class="form-control">{{ auth()->user()->weight }} kg</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label"><strong>Age</strong></label>
                            <p class="form-control">{{ auth()->user()->age }} years</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label"><strong>Gender</strong></label>
                            <p class="form-control">{{ ucfirst(auth()->user()->gender) }}</p>
                        </div>
                    </div>
                </div>

                <!-- Edit Profile Button -->
                <div class="text-center mt-4">
                    <a href="{{ route('profile.edit') }}" class="btn btn-primary">Edit Profile</a>
                </div>
            </div>
        </div>
    </div>
@endsection
