@extends('layouts.user')

@section('title', 'Workouts')

@section('content')
    <div class="container">
        <h1 class="text-center my-4">Available Workouts</h1>

        {{-- Display error message if any --}}
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        {{-- Check if workouts are available --}}
        {{-- @if ($workouts->isEmpty())
            <p class="text-center">No workouts available at the moment. Please check back later.</p>
        @else --}}
            <div class="row">
                @foreach ($workouts as $workout)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            @if ($workout->image)
                                <img src="{{ asset('storage/' . $workout->image) }}" class="card-img-top" alt="{{ $workout->name }}">
                            @else
                                <img src="{{ asset('images/default-workout.jpg') }}" class="card-img-top" alt="Default Workout">
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">{{ $workout->name }}</h5>
                                <p class="card-text"><strong>Duration:</strong> {{ $workout->duration }} minutes</p>
                                <p class="card-text"><strong>Intensity:</strong> {{ $workout->intensity ?? 'N/A' }}</p>
                                <p class="card-text"><strong>Equipment:</strong> {{ $workout->equipment ?? 'None' }}</p>
                                <p class="card-text"><strong>Muscle Groups:</strong> {{ $workout->muscle_groups ?? 'N/A' }}</p>
                                <p class="card-text"><strong>Instructions:</strong> {{ $workout->instructions ?? 'N/A' }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        {{-- @endif --}}
    </div>
@endsection
