@extends('layouts.app')

@section('title', 'Login Admin')

@section('content')

<h1>Login Admin</h1>

@if (session('success'))
    <div class="card">
        {{ session('success') }}
    </div>
@endif

@if ($errors->any())
    <div class="card">
        <strong>Terjadi kesalahan:</strong>

        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="card">

    <form action="{{ route('login.store') }}" method="POST">

        @csrf

        <p>
            <label>Email</label><br>

            <input
                type="email"
                name="email"
                value="{{ old('email') }}"
                required
                autofocus
            >
        </p>

        <p>
            <label>Password</label><br>

            <input
                type="password"
                name="password"
                required
            >
        </p>

        <button type="submit">
            Login
        </button>

    </form>

</div>

@endsection
