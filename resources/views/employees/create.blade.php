@extends('layouts.app')

@section('content')
<div class="container">
    <h2>{{ isset($employee) ? 'Edit' : 'Add' }} Employee</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ isset($employee) ? route('employees.update', $employee->id) : route('employees.store') }}" method="POST">
        @csrf
        @if(isset($employee))
            @method('PUT')
        @endif

        <div class="mb-3">
            <label for="employee_id" class="form-label">Employee ID</label>
            <input type="text" name="employee_id" class="form-control" value="{{ old('employee_id', $employee->employee_id ?? '') }}" required >
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $employee->name ?? '') }}" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $employee->email ?? '') }}" required>
        </div>
        <div class="mb-3">
            <label for="dob" class="form-label">Date of Birth</label>
            <input type="date" name="dob" class="form-control" value="{{ old('dob', $employee->dob ?? '') }}" required>
        </div>
        <div class="mb-3">
            <label for="doj" class="form-label">Date of Joining</label>
            <input type="date" name="doj" class="form-control" value="{{ old('doj', $employee->doj ?? '') }}" required>
        </div>

        <button type="submit" class="btn btn-success">{{ isset($employee) ? 'Update' : 'Submit' }}</button>
        <a href="{{ route('employees.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
