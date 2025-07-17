@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Create New User</h2>

    <!-- Form untuk membuat pengguna baru -->
    <form action="{{ route('admin.store-user') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>

        <div class="form-group">
            <label for="role">Role</label>
            <select class="form-control" id="role" name="role" required>
                <option value="masyarakat">Masyarakat</option>
                <option value="admin">Admin</option>
                <option value="stakeholder">Stakeholder</option>
            </select>
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Create User</button>
    </form>
</div>
@endsection
