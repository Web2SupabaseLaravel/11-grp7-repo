@extends('layout')

@section('content')
    <h2>Register</h2>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <form method="POST" action="{{ url('/register') }}">
        @csrf
        <div class="mb-3">
            <label for="role" class="form-label">Role:</label>
            <select class="form-control" id="role" name="role" required>
                <option value="patient">Patient</option>
                <option value="practitioner">Practitioner</option>
                <option value="admin">Admin</option>
            </select>
            @error('role')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="full_name" class="form-label">Full Name:</label>
            <input type="text" class="form-control" id="full_name" name="full_name">
            @error('full_name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3" id="staff_id_field" style="display: none;">
            <label for="staff_id" class="form-label">Staff ID:</label>
            <input type="text" class="form-control" id="staff_id" name="staff_id">
            @error('staff_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" class="form-control" id="email" name="email" required>
            @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password:</label>
            <input type="password" class="form-control" id="password" name="password" required>
            @error('password')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary w-100">Register</button>
    </form>
    <script>
        document.getElementById('role').addEventListener('change', function () {
            const staffIdField = document.getElementById('staff_id_field');
            if (this.value === 'admin') {
                staffIdField.style.display = 'block';
            } else {
                staffIdField.style.display = 'none';
            }
        });
    </script>
@endsection