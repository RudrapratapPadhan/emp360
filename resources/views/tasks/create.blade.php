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

            <form action="/tasks/create" method="POST" id="task-form">
                @csrf
                <div class="row g-3">
                    <div class="col-md-12">
                        <label class="form-label">Task Title *</label>
                        <input type="text" name="title" id="title" class="form-control" required>
                        <p id="title-error" class="text-danger small"></p>
                    </div>

                    <div class="col-md-12">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control" rows="4"></textarea>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Assign to Employee *</label>
                        <select name="employee_id" id="employee_id" class="form-control" required>
                            <option value="">-- Select Employee --</option>
                            @foreach($employees as $emp)
                                <option value="{{ $emp->id }}">{{ $emp->name }} ({{ $emp->email }})</option>
                            @endforeach
                        </select>
                        <p id="employee-error" class="text-danger small"></p>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Priority *</label>
                        <select name="priority" id="priority" class="form-control" required>
                            <option value="low">Low</option>
                            <option value="medium" selected>Medium</option>
                            <option value="high">High</option>
                            <option value="urgent">Urgent</option>
                        </select>
                        <p id="priority-error" class="text-danger small"></p>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Due Date</label>
                        <input type="date" name="due_date" id="due_date" class="form-control">
                        <p id="date-error" class="text-danger small"></p>
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

<script src="{{ asset('js/task_form.js') }}"></script>
<script>
document.getElementById('task-form').addEventListener('submit', validateTaskForm);
</script>
@endsection