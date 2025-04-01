@extends('layouts.user')

@section('title', 'Workouts')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-4">Available Workouts</h1>

        <!-- Grid Layout for Static Workouts -->
        <div class="row g-4">
            <!-- Strength & Muscle Building -->
            <div class="col-md-4">
                <div class="card h-100">
                    <img src="image/strength.png" class="card-img-top workout-img" alt="Strength & Muscle Building">
                    <div class="card-body">
                        <h5 class="card-title text-primary">Strength & Muscle Building</h5>
                        <p class="card-text">Build your strength with these workouts.</p>
                    </div>
                </div>
            </div>

            <!-- Endurance & Stamina -->
            <div class="col-md-4">
                <div class="card h-100">
                    <img src="image/endurance.jpg" class="card-img-top workout-img" alt="Endurance & Stamina">
                    <div class="card-body">
                        <h5 class="card-title text-success">Endurance & Stamina</h5>
                        <p class="card-text">Improve your stamina with these workouts.</p>
                    </div>
                </div>
            </div>

            <!-- Flexibility & Mobility -->
            <div class="col-md-4">
                <div class="card h-100">
                    <img src="image/flexibility.png" class="card-img-top workout-img" alt="Flexibility & Mobility">
                    <div class="card-body">
                        <h5 class="card-title text-warning">Flexibility & Mobility</h5>
                        <p class="card-text">Enhance your flexibility with these workouts.</p>
                    </div>
                </div>
            </div>

            <!-- Core & Abs -->
            <div class="col-md-4">
                <div class="card h-100">
                    <img src="image/abs.png" class="card-img-top workout-img" alt="Core & Abs">
                    <div class="card-body">
                        <h5 class="card-title text-danger">Core & Abs</h5>
                        <p class="card-text">Strengthen your core with these workouts.</p>
                    </div>
                </div>
            </div>

            <!-- Functional & Athletic Training -->
            <div class="col-md-4">
                <div class="card h-100">
                    <img src="image/athletic.jpg" class="card-img-top workout-img" alt="Functional & Athletic Training">
                    <div class="card-body">
                        <h5 class="card-title text-info">Functional & Athletic Training</h5>
                        <p class="card-text">Train like an athlete with these workouts.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
