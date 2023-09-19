@extends('layouts.admin')

@section('title', 'Create users')
@section('content-header', 'Create Users')

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('users.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="role">Role</label>
                    <select name="role" id="role" class="form-control" required>
                        <option value="">Select Role</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" name="address" id="address" class="form-control">
                </div>
                <div class="form-group">
                    <label for="phone_number">Phone Number</label>
                    <input type="text" name="phone_number" id="phone_number" class="form-control">
                </div>
                <button type="submit" class="btn">Create</button>
            </form>
        </div>
    </div>

    <style>
    .btn {
    background-color: #5541D7;
    color: #fff;
    font-family: 'Roboto', sans-serif;
    border: 1px solid #5541D7; /* Add an outline */
    }

    /* Button hover styles */
    .btn:hover {
        background-color: #fff;
        color: #5541D7;
        border: 1px solid #5541D7; /* Add an outline */
    }
    </style>
@endsection
