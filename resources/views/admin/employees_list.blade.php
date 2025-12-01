@extends('base')

@section('title')
Employees List
@endsection

@section('mainblock')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold">All Employees</h1>
        <a href="/admin/dashboard" class="btn btn-secondary">Back to Dashboard</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Employee Directory ({{ $employee->total() }} total)</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-striped mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Age</th>
                            <th>DOB</th>
                            <th>Father's Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($employee as $emp)
                        <tr>
                            <td>{{ $emp->id }}</td>
                            <td>{{ $emp->name }}</td>
                            <td>{{ $emp->email }}</td>
                            <td>{{ $emp->mobile }}</td>
                            <td>{{ $emp->age }}</td>
                            <td>{{ $emp->dob }}</td>
                            <td>{{ $emp->father_name }}</td>
                            <td>
                                <a href="/employees/update/{{ $emp->id }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="/employees/delete/{{ $emp->id }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete {{ $emp->name }}?')">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted py-4">No employees found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">
            {{ $employee->links() }}
        </div>
    </div>
</div>
@endsection