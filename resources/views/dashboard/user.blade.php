@extends('layouts.user')

@section('title', 'Home')

@section('content')
    <div class="container mt-5">
        <h2>Welcome, {{ auth()->user()->name }}!</h2>

        <!-- Static data for workouts completed -->
        <p>You have completed <strong>5</strong> workouts this week and <strong>20</strong> workouts this month.</p>

        <!-- Workout Progress -->
        <div class="mt-4">
            <h4>Workout Progress</h4>
            <div class="progress mb-3" style="height: 25px;">
                <div class="progress-bar bg-success" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                    5 Workouts
                </div>
            </div>
            <p>Goal: 10 Workouts</p>
        </div>

        <!-- Weekly Stats -->
        <div class="mt-5">
            <h4>Workouts This Week</h4>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Workout Name</th>
                        <th>Date</th>
                        <th>Duration (mins)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Strength Training</td>
                        <td>2025-03-31</td>
                        <td>45</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Cardio</td>
                        <td>2025-03-30</td>
                        <td>30</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Yoga</td>
                        <td>2025-03-29</td>
                        <td>60</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Monthly Stats -->
        <div class="mt-5">
            <h4>Workouts This Month</h4>
            <div class="row">
                <div class="col-md-4">
                    <div class="card text-white bg-primary mb-3">
                        <div class="card-header">Strength Training</div>
                        <div class="card-body">
                            <h5 class="card-title">10 Sessions</h5>
                            <p class="card-text">Total Duration: 450 mins</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-white bg-success mb-3">
                        <div class="card-header">Cardio</div>
                        <div class="card-body">
                            <h5 class="card-title">5 Sessions</h5>
                            <p class="card-text">Total Duration: 150 mins</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-white bg-warning mb-3">
                        <div class="card-header">Yoga</div>
                        <div class="card-body">
                            <h5 class="card-title">5 Sessions</h5>
                            <p class="card-text">Total Duration: 300 mins</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

