@extends('base')

@section('title', 'Update Task')

@section('mainblock')
<div class="container mt-4">
    <div class="card">
        <div class="card-header bg-warning text-dark">
            <h3 class="mb-0">Update Task</h3>
        </div>
        <div class="card-body">
            @if(isset($error) && $error != '')
                <div class="alert alert-danger">{{ $error }}</div>
            @endif

            <form action="/tasks/update/{{ $task->id }}" method="POST">
                @csrf
                <div class="row g-3">
                    <div class="col-md-12">
                        <label class="form-label">Task Title *</label>
                        <input type="text" name="title" class="form-control" value="{{ $task->title }}" required>
                    </div>

                    <div class="col-md-12">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control" rows="4">{{ $task->description }}</textarea>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Assign to Employee *</label>
                        <select name="employee_id" class="form-control" required>
                            @foreach($employees as $emp)
                                <option value="{{ $emp->id }}" {{ $task->user_id == $emp->id ? 'selected' : '' }}>
                                    {{ $emp->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Priority *</label>
                        <select name="priority" class="form-control" required>
                            <option value="low" {{ $task->priority == 'low' ? 'selected' : '' }}>Low</option>
                            <option value="medium" {{ $task->priority == 'medium' ? 'selected' : '' }}>Medium</option>
                            <option value="high" {{ $task->priority == 'high' ? 'selected' : '' }}>High</option>
                            <option value="urgent" {{ $task->priority == 'urgent' ? 'selected' : '' }}>Urgent</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Status *</label>
                        <select name="status" class="form-control" required>
                            <option value="pending" {{ $task->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="in_progress" {{ $task->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                            <option value="completed" {{ $task->status == 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="cancelled" {{ $task->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Due Date</label>
                        <input type="date" name="due_date" class="form-control" value="{{ $task->due_date }}">
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-warning">Update Task</button>
                    <a href="/admin/dashboard" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection