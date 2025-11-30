@extends('base')

@section('title', 'Assign New Task')

@section('mainblock')
<div class="container mt-4">
    <div class="card">
        <div class="card-header bg-success text-white">
            <h3 class="mb-0">Assign New Task to Employee</h3>
        </div>
        <div class="card-body">
            @if(isset($error) && $error != '')
                <div class="alert alert-danger">{{ $error }}</div>
            @endif

            <form action="/tasks/create" method="POST">
                @csrf
                <div class="row g-3">
                    <div class="col-md-12">
                        <label class="form-label">Task Title *</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>

                    <div class="col-md-12">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control" rows="4"></textarea>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Assign to Employee *</label>
                        <select name="employee_id" class="form-control" required>
                            <option value="">-- Select Employee --</option>
                            @foreach($employees as $emp)
                                <option value="{{ $emp->id }}">{{ $emp->name }} ({{ $emp->email }})</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Priority *</label>
                        <select name="priority" class="form-control" required>
                            <option value="low">Low</option>
                            <option value="medium" selected>Medium</option>
                            <option value="high">High</option>
                            <option value="urgent">Urgent</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Due Date</label>
                        <input type="date" name="due_date" class="form-control">
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-success">Assign Task</button>
                    <a href="/admin/dashboard" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection