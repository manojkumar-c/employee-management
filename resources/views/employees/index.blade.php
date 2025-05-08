@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Employee List</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(auth()->user()->role === 'admin')
        <a href="{{ route('employees.create') }}" class="btn btn-primary mb-3">Add Employee</a>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>S.No</th>
                <th>Employee ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>DOB</th>
                <th>DOJ</th>
                @if(auth()->user()->role === 'admin')
                    <th>Actions</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @forelse($employees as $index => $employee)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $employee->employee_id }}</td>
                    <td>{{ $employee->name }}</td>
                    <td>{{ $employee->email }}</td>
                    <td>{{ $employee->dob }}</td>
                    <td>{{ $employee->doj }}</td>
                    @if(auth()->user()->role === 'admin')
                        <td>
                            <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" style="display:inline;">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    @endif
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">No data available</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
