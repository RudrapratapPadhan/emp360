@extends('base')

@section('title')
Admin
@endsection

@section('mainblock')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold">Admin Dashboard</h1>
        <form action="/logout" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger">Logout</button>
        </form>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-md-6 col-lg-3">
            <div class="card text-white bg-primary h-100">
                <div class="card-body text-center">
                    <h5 class="card-title">Total Employees</h5>
                    <h2 class="display-4 mb-0">{{ $totalEmployees ?? 0 }}</h2>
                    <p class="mt-2 mb-0">Active employees in system</p>
                </div>
                <div class="card-footer bg-transparent border-0">
                    <a href="/employees" class="btn btn-light btn-sm w-100">View All Employees</a>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="card text-white bg-success h-100">
                <div class="card-body text-center">
                    <h5 class="card-title">Total Tasks</h5>
                    <h2 class="display-4 mb-0">{{ $totalTasks ?? 0 }}</h2>
                    <p class="mt-2 mb-0">Tasks assigned to employees</p>
                </div>
                <div class="card-footer bg-transparent border-0">
                    <a href="/tasks" class="btn btn-light btn-sm w-100">View All Tasks</a>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="card text-white bg-warning h-100">
                <div class="card-body text-center">
                    <h5 class="card-title">Pending Tasks</h5>
                    <h2 class="display-4 mb-0">{{ $pendingTasks ?? 0 }}</h2>
                    <p class="mt-2 mb-0">Tasks awaiting completion</p>
                </div>
                <div class="card-footer bg-transparent border-0">
                    <a href="/tasks?status=pending" class="btn btn-light btn-sm w-100">View Pending</a>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="card text-white bg-info h-100">
                <div class="card-body text-center">
                    <h5 class="card-title">Completed Tasks</h5>
                    <h2 class="display-4 mb-0">{{ $completedTasks ?? 0 }}</h2>
                    <p class="mt-2 mb-0">Tasks successfully finished</p>
                </div>
                <div class="card-footer bg-transparent border-0">
                    <a href="/tasks?status=completed" class="btn btn-light btn-sm w-100">View Completed</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-6 col-lg-4">
            <div class="card h-100 shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="bi bi-people"></i> Manage Employees</h5>
                </div>
                <div class="card-body">
                    <p class="card-text">Add, edit, view, or remove employees from the system.</p>
                    <div class="d-grid gap-2">
                        <a href="/employees" class="btn btn-outline-primary">View All Employees</a>
                        <a href="/employees/create" class="btn btn-primary">Add New Employee</a>
                        <button class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteEmployeeModal">Delete Employee</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-4">
            <div class="card h-100 shadow-sm">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0"><i class="bi bi-list-task"></i> Task Management</h5>
                </div>
                <div class="card-body">
                    <p class="card-text">Assign, update, or delete tasks for employees.</p>
                    <div class="d-grid gap-2">
                        <a href="/tasks" class="btn btn-outline-success">View All Tasks</a>
                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#assignTaskModal">Assign New Task</button>
                        <button class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#updateTaskModal">Update Task</button>
                        <button class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteTaskModal">Delete Task</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-4">
            <div class="card h-100 shadow-sm">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0"><i class="bi bi-graph-up"></i> Quick Actions</h5>
                </div>
                <div class="card-body">
                    <p class="card-text">Quick access to system features.</p>
                    <div class="d-grid gap-2">
                        <a href="/employees" class="btn btn-outline-info">Employee Directory</a>
                        <a href="/tasks" class="btn btn-outline-info">Task Overview</a>
                        <button class="btn btn-info" onclick="window.print()">Print Report</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Assign Task Modal -->
<div class="modal fade" id="assignTaskModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title">Assign New Task</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="/tasks/create" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Task Title *</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control" rows="3"></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Assign to Employee *</label>
                            <select name="employee_id" class="form-select" required>
                                <option value="">-- Select Employee --</option>
                                @foreach($employee as $emp)
                                    <option value="{{ $emp->id }}">{{ $emp->name }} ({{ $emp->email }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Priority *</label>
                            <select name="priority" class="form-select" required>
                                <option value="low">Low</option>
                                <option value="medium" selected>Medium</option>
                                <option value="high">High</option>
                                <option value="urgent">Urgent</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Due Date</label>
                        <input type="date" name="due_date" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Assign Task</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Update Task Modal -->
<div class="modal fade" id="updateTaskModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-warning text-dark">
                <h5 class="modal-title">Update Task</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Select task to update:</p>
                <form action="" method="GET" id="updateTaskForm">
                    <select class="form-select" id="taskUpdateSelect" required>
                        <option value="">-- Select Task --</option>
                        @php
                            $tasks = \App\Models\Task::with('user')->latest()->get();
                        @endphp
                        @foreach($tasks as $task)
                            <option value="{{ $task->id }}">
                                {{ $task->title }} - {{ $task->user->name }} ({{ ucfirst($task->status) }})
                            </option>
                        @endforeach
                    </select>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-warning" onclick="updateTask()">Update</button>
            </div>
        </div>
    </div>
</div>

<!-- Delete Task Modal -->
<div class="modal fade" id="deleteTaskModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">Delete Task</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Select task to delete:</p>
                <form action="" method="POST" id="deleteTaskForm">
                    @csrf
                    <select class="form-select" id="taskDeleteSelect" required>
                        <option value="">-- Select Task --</option>
                        @foreach($tasks as $task)
                            <option value="{{ $task->id }}">
                                {{ $task->title }} - {{ $task->user->name }}
                            </option>
                        @endforeach
                    </select>
                </form>
                <div class="alert alert-warning mt-3">
                    Warning: This action cannot be undone!
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" onclick="deleteTask()">Delete</button>
            </div>
        </div>
    </div>
</div>

<!-- Delete Employee Modal -->
<div class="modal fade" id="deleteEmployeeModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">Delete Employee</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Select employee to delete:</p>
                <form action="" method="POST" id="deleteForm">
                    @csrf
                    <select class="form-select" name="employee_id" id="employeeSelect" required>
                        <option value="">-- Select Employee --</option>
                        @foreach($employee as $emp)
                            <option value="{{ $emp->id }}">{{ $emp->name }} ({{ $emp->email }})</option>
                        @endforeach
                    </select>
                </form>
                <div class="alert alert-warning mt-3">
                    Warning: This will also delete all tasks assigned to this employee!
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" onclick="confirmDelete()">Delete</button>
            </div>
        </div>
    </div>
</div>

<script>
// Delete employee
function confirmDelete() {
    let empId = document.getElementById('employeeSelect').value;
    if(empId){
        document.getElementById('deleteForm').action = `/employees/delete/${empId}`;
        document.getElementById('deleteForm').submit(); 
    } else {
        alert('Please select an employee');
    }
}

// Update task
function updateTask() {
    let taskId = document.getElementById('taskUpdateSelect').value;
    if(taskId){
        window.location.href = `/tasks/update/${taskId}`;
    } else {
        alert('Please select a task');
    }
}

// Delete task
function deleteTask() {
    let taskId = document.getElementById('taskDeleteSelect').value;
    if(taskId){
        if(confirm('Are you sure you want to delete this task?')){
            document.getElementById('deleteTaskForm').action = `/tasks/delete/${taskId}`;
            document.getElementById('deleteTaskForm').submit();
        }
    } else {
        alert('Please select a task');
    }
}
</script>

@endsection