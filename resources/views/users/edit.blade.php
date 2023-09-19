@extends('layouts.admin')

@section('title', 'Edit User')
@section('content-header', 'Edit User')

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}" required>
                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" class="form-control" value="{{ $user->username }}" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" class="form-control" value="{{ $user->email }}" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control">
                    <small class="form-text text-muted">Biarkan kosong apabila tidak ada perubahan</small>
                </div>
                <div class="form-group">
                    <label for="role">Role</label>
                    <select name="role" id="role" class="form-control" required>
                        <option value="">Select Role</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}" @if ($user->roles->contains($role)) selected @endif>{{ $role->name }}</option>
                        @endforeach
                    </select>
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" name="address" id="address" class="form-control" value="{{ $user->address }}">
                </div>
                <div class="form-group">
                    <label for="phone_number">Nomor Handphone</label>
                    <input type="text" name="phone_number" id="phone_number" class="form-control" value="{{ $user->phone_number }}">
                </div>
                <button type="submit" class="btn">Simpan</button>
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
