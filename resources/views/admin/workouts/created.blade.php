@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4">Workouts Created by Admin</h2>
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Duration (mins)</th>
                <th>Intensity</th>
                <th>Equipment</th>
                <th>Muscle Groups</th>
                {{-- <th>Actions</th> --}}
            </tr>
        </thead>
        <tbody>
            @forelse($workouts as $workout)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $workout->name }}</td>
                <td>{{ $workout->duration }}</td>
                <td>{{ $workout->intensity }}</td>
                <td>{{ $workout->equipment ?? 'None' }}</td>
                <td>{{ $workout->muscle_groups }}</td>

                {{-- <td>
                     <a href="{{ route('workouts.edit', $workout->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('workouts.destroy', $workout->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td> --}}

            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center">No workouts found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
