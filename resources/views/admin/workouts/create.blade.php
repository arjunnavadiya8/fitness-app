@extends('layouts.admin')

@section('content') <div class="container mt-5">
    <h2 class="text-center mb-4">Add a New Workout</h2>
    <form action="{{ route('admin.workouts.store') }}" method="POST" enctype="multipart/form-data" class="p-4 border rounded shadow-sm bg-light">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Workout Name:</label>
            <input type="text" id="name" name="name" class="form-control" placeholder="Enter workout name" required>
        </div>

        <div class="mb-3">
            <label for="duration" class="form-label">Duration (in minutes):</label>
            <input type="number" id="duration" name="duration" class="form-control" placeholder="Enter duration" min="1" required>
        </div>

        <div class="mb-3">
            <label for="intensity" class="form-label">Intensity Level:</label>
            <select id="intensity" name="intensity" class="form-select" required>
                <option value="" disabled selected>Select intensity level</option>
                <option value="Easy">Easy</option>
                <option value="Moderate">Moderate</option>
                <option value="Hard">Hard</option>
                <option value="Beast Mode">Beast Mode</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="equipment" class="form-label">Equipment Needed:</label>
            <input type="text" id="equipment" name="equipment" class="form-control" placeholder="Enter equipment needed">
        </div>

        <div class="mb-3">
            <label for="muscle_groups" class="form-label">Targeted Muscle Groups:</label>
            <select id="muscle_groups" name="muscle_groups" class="form-select" required>
                <option value="" disabled selected>Select muscle group</option>
                <option value="Chest">Chest</option>
                <option value="Back">Back</option>
                <option value="Legs">Legs</option>
                <option value="Arms">Arms</option>
                <option value="Shoulders">Shoulders</option>
                <option value="Core">Core</option>
                <option value="Full Body">Full Body</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="instructions" class="form-label">Instructions:</label>
            <textarea id="instructions" name="instructions" class="form-control" rows="3" placeholder="Enter workout instructions"></textarea>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Upload Workout Image:</label>
            <input type="file" id="image" name="image" class="form-control" accept="image/*">
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary">Create Workout</button>
        </div>
    </form>
</div>
@endsection
