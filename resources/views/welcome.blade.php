@extends('layouts.user')

@section('title', 'Home')

@section('content')
    <h1>Welcome to the Fitness App</h1>
    <p>Get started by logging in to access your personalized dashboard and workout plans.</p>

    <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
@endsection
