@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit User</h2>

    <!-- Form untuk edit user -->
    <form action="{{ route('admin.update-user', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
        </div>

        <div class="form-group">
            <label for="role">Role</label>
            <select class="form-control" id="role" name="role" required>
                <option value="masyarakat" {{ $user->role == 'masyarakat' ? 'selected' : '' }}>Masyarakat</option>
                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="stakeholder" {{ $user->role == 'stakeholder' ? 'selected' : '' }}>Stakeholder</option>
            </select>
        </div>

        <div class="form-group">
            <label for="password">Password <small>(Kosongkan jika tidak diubah)</small></label>
            <input type="password" class="form-control" id="password" name="password">
        </div>

        <button type="submit" class="btn btn-success mt-3">Update User</button>
    </form>
</div>
@endsection
