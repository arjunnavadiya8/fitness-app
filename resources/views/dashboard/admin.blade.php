@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
    <div class="container">

        <!-- Workouts List -->
        <h1 class="mb-4">Settings</h1>

        @if ($workouts->isEmpty())
            <p>No workouts found.</p>
        @else
            <table class="table table-bordered table-striped mt-3">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Duration</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($workouts as $workout)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $workout->title }}</td>
                            <td>{{ $workout->description }}</td>
                            <td>{{ $workout->duration }} mins</td>
                            <td>
                                <!-- Edit Button -->
                                <a href="{{ route('admin.edit-workout', $workout->id) }}" class="btn btn-sm btn-primary">Edit</a>

                                <!-- Delete Button -->
                                <form action="{{ route('admin.delete-workout', $workout->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this workout?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
