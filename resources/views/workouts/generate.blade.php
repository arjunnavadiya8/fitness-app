@extends('layouts.user')

@section('title', 'Generate Workout')

@section('content')
    <div class="container mt-5">
        <h1>Generate Workout Plan</h1>

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form action="{{ route('generate-workout') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="goal" class="form-label">Fitness Goal</label>
                <input type="text" name="goal" id="goal" class="form-control" placeholder="e.g., Build muscle, Lose weight" required>
            </div>
            <div class="mb-3">
                <label for="fitness_level" class="form-label">Fitness Level</label>
                <select name="fitness_level" id="fitness_level" class="form-select" required>
                    <option value="beginner">Beginner</option>
                    <option value="intermediate">Intermediate</option>
                    <option value="advanced">Advanced</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="duration" class="form-label">Workout Duration (in minutes)</label>
                <input type="number" name="duration" id="duration" class="form-control" min="10" max="120" required>
            </div>
            <button type="submit" class="btn btn-primary">Generate Workout</button>
        </form>
    </div>
@endsection
