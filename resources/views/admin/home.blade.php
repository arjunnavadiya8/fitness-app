@extends('layouts.admin')

@section('title', 'Home')

@section('content')
    <div class="container mt-5">
        <h2>Welcome, {{ auth()->user()->name }}!</h2>
        <p>You are logged in as a <strong>Admin</strong>.</p>
        <a href="{{ route('logout') }}" class="btn btn-danger"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            Logout
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>
@endsection

