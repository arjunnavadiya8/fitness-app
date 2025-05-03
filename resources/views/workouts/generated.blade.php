{{-- @extends('layouts.user')

@section('title', 'Generated Workout')

@section('content')

    <div class="container mt-5">
        <h1>Generated Workout Plan</h1>

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @if(is_array($generatedWorkout) && !empty($generatedWorkout))
            <p><strong>Goal:</strong> {{ $generatedWorkout['goal'] ?? 'N/A' }}</p>
            <p><strong>Fitness Level:</strong> {{ ucfirst($generatedWorkout['fitness_level'] ?? 'N/A') }}</p>
            <p><strong>Duration:</strong> {{ $generatedWorkout['duration'] ?? 'N/A' }} minutes</p>

            <h3>Workout Details:</h3>
            @if (!empty($generatedWorkout['exercises']) && is_array($generatedWorkout['exercises']))
                @foreach ($generatedWorkout['exercises'] as $section => $exercises)
                    <h4>{{ $section }}</h4>
                    <ul>
                        @if (is_array($exercises))
                            @foreach ($exercises as $exercise)
                                <li>
                                    <strong>{{ $exercise['name'] }}</strong>
                                    @if ($exercise['sets'] !== 'N/A' && $exercise['reps'] !== 'N/A')
                                        <br>
                                        <em>{{ $exercise['sets'] }} sets of {{ $exercise['reps'] }} reps</em>
                                    @endif
                                    @if (!empty($exercise['description']))
                                        <br>
                                        <span>{{ $exercise['description'] }}</span>
                                    @endif
                                </li>
                            @endforeach
                        @else
                            <li>No exercises available in this section.</li>
                        @endif
                    </ul>
                @endforeach
            @else
                <p>No exercises available.</p>
            @endif
        @else
            <p>No valid workout data available.</p>
        @endif

        <a href="{{ route('generate-workout.form') }}" class="btn btn-secondary mt-3">Generate Another Workout</a>
    </div>

@endsection --}}
{{--
@extends('layouts.user')

@section('title', 'Generated Workout Plan')

@section('content')
    <div class="container mt-5">
        <h1>Your Custom Workout Plan</h1>

        @if(isset($generatedWorkout))
            <div class="card mb-4">
                <div class="card-header">
                    <h3>Workout Details</h3>
                </div>
                <div class="card-body">
                    <p><strong>Goal:</strong> {{ $generatedWorkout['goal'] }}</p>
                    <p><strong>Fitness Level:</strong> {{ ucfirst($generatedWorkout['fitness_level']) }}</p>
                    <p><strong>Duration:</strong> {{ $generatedWorkout['duration'] }} minutes</p>
                </div>
            </div>

            <div id="workoutCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    @foreach($generatedWorkout['exercises'] as $section => $exercises)
                        <button type="button" data-bs-target="#workoutCarousel"
                                data-bs-slide-to="{{ $loop->index }}"
                                class="{{ $loop->first ? 'active' : '' }}"
                                aria-current="{{ $loop->first ? 'true' : 'false' }}"
                                aria-label="Slide {{ $loop->index + 1 }}"></button>
                    @endforeach
                </div>

                <div class="carousel-inner">
                    @foreach($generatedWorkout['exercises'] as $section => $exercises)
                        <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                            <div class="card">
                                <div class="card-header bg-primary text-white">
                                    <h3>{{ $section }}</h3>
                                </div>
                                <div class="card-body">
                                    <ul class="list-group">
                                        @foreach($exercises as $exercise)
                                            <li class="list-group-item">
                                                <h5>{{ $exercise['name'] }}</h5>
                                                @if($exercise['sets'] !== 'N/A' && $exercise['reps'] !== 'N/A')
                                                    <p>{{ $exercise['sets'] }} sets of {{ $exercise['reps'] }} reps</p>
                                                @endif
                                                @if(!empty($exercise['description']))
                                                    <p class="text-muted">{{ $exercise['description'] }}</p>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <button class="carousel-control-prev" type="button" data-bs-target="#workoutCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#workoutCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>

            <div class="mt-3">
                <a href="{{ route('generate-workout.form') }}" class="btn btn-secondary">Generate Another Workout</a>
            </div>
        @else
            <div class="alert alert-warning">
                No workout data available. Please generate a workout first.
            </div>
            <a href="{{ route('generate-workout.form') }}" class="btn btn-primary">Generate Workout</a>
        @endif
    </div>

    <style>
        .carousel-item {
            padding: 20px;
        }
        .carousel-inner {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .list-group-item {
            margin-bottom: 10px;
            border-radius: 5px;
        }
    </style>
@endsection --}}


@extends('layouts.user')

@section('title', 'Generated Workout Plan')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-primary text-white">
                        <h2 class="h5 mb-0">Your Custom Workout Plan</h2>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <p><strong>Goal:</strong> {{ $workout['goal'] }}</p>
                            </div>
                            <div class="col-md-4">
                                <p><strong>Level:</strong> {{ ucfirst($workout['fitness_level']) }}</p>
                            </div>
                            <div class="col-md-4">
                                <p><strong>Duration:</strong> {{ $workout['duration'] }} minutes</p>
                            </div>
                        </div>
                        <p class="text-muted mb-0">
                            <small>Generated on: {{ $workout['generated_at'] }}</small>
                        </p>
                    </div>
                </div>

                @if(count($workout['exercises']) > 0)
                    <div id="workoutCarousel" class="carousel slide mb-4" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            @foreach($sections as $index => $section)
                                <button type="button" data-bs-target="#workoutCarousel"
                                        data-bs-slide-to="{{ $index }}"
                                        class="{{ $index === 0 ? 'active' : '' }}"
                                        aria-label="Slide {{ $index + 1 }}"></button>
                            @endforeach
                        </div>

                        <div class="carousel-inner rounded">
                            @foreach($workout['exercises'] as $section => $exercises)
                                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                    <div class="card border-0">
                                        <div class="card-header bg-secondary text-white">
                                            <h3 class="h5 mb-0">{{ $section }}</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                @foreach($exercises as $exercise)
                                                    <div class="col-md-6 mb-3">
                                                        <div class="card h-100">
                                                            <div class="card-body">
                                                                <h5 class="card-title text-primary">
                                                                    {{ $exercise['name'] }}
                                                                </h5>

                                                                @if($exercise['sets'] !== 'N/A' && $exercise['reps'] !== 'N/A')
                                                                    <p class="mb-2">
                                                                        <span class="badge bg-info text-dark">
                                                                            {{ $exercise['sets'] }} sets × {{ $exercise['reps'] }} reps
                                                                        </span>
                                                                    </p>
                                                                @endif

                                                                @if(!empty($exercise['description']))
                                                                    <div class="exercise-description">
                                                                        <p class="card-text">{{ $exercise['description'] }}</p>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <button class="carousel-control-prev" type="button" data-bs-target="#workoutCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#workoutCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                @else
                    <div class="alert alert-warning">
                        No exercises were generated for this workout.
                    </div>
                @endif

                <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-3">
                    <a href="{{ route('generate-workout.form') }}" class="btn btn-outline-primary me-md-2">
                        <i class="bi bi-arrow-repeat"></i> Generate New Workout
                    </a>
                    {{-- <button class="btn btn-primary" onclick="window.print()">
                        <i class="bi bi-printer"></i> Print Workout
                    </button> --}}
                </div>
            </div>
        </div>
    </div>

    <style>
        .carousel {
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }
        .carousel-indicators button {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            margin: 0 5px;
        }
        .exercise-description {
            border-left: 3px solid #0d6efd;
            padding-left: 10px;
            font-size: 0.9rem;
        }
        @media print {
            .carousel-control, .d-md-flex {
                display: none !important;
            }
            .carousel-inner {
                display: block !important;
            }
            .carousel-item {
                display: block !important;
                opacity: 1 !important;
                page-break-after: always;
            }
        }
    </style>
@endsection
