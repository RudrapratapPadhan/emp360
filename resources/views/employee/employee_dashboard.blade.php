@extends('base')

@section('title')
Employee
@endsection

@section('mainblock')
<div class="container mt-4">
    <h1 class="mb-4">Employee Dashboard</h1>
    
    <div class="row g-4">
        <!-- Card 1: Employee Details -->
        <div class="col-md-6">
            <div class="card h-100 text-bg-success">
                <div class="card-header">
                    <h4 class="card-title">Welcome, {{ $employee->name }}</h4>
                </div>
                <div class="card-body">
                    <p><strong>Email:</strong> {{ $employee->email }}</p>
                    <p><strong>Mobile:</strong> {{ $employee->mobile ?? 'N/A' }}</p>
                    <p><strong>Age:</strong> {{ $employee->age ?? 'N/A' }}</p>
                    <p><strong>Date of Birth:</strong> {{ $employee->dob ?? 'N/A' }}</p>
                    <p><strong>Father's Name:</strong> {{ $employee->father_name ?? 'N/A' }}</p>
                    
                    <form action="/logout" method="POST" class="mt-3" id="logout-form" onsubmit="handleDashBoard(event)">
                        @csrf
                        <button type="submit" class="btn btn-danger">Logout</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Card 2: Task Summary -->
        <div class="col-md-6">
            <div class="card h-100 text-bg-info">
                <div class="card-header">
                    <h4 class="card-title">Task Summary</h4>
                </div>
                <div class="card-body">
                    <p><strong>Total Tasks Completed:</strong> {{ $completedTasks }}</p>
                    <p><strong>Pending Tasks:</strong> {{ $pendingTasks }}</p>
                    <p><strong>This Month Assigned:</strong> {{ $thisMonthTasksAssigned }}</p>
                    <p><strong>This Month Completed:</strong> {{ $thisMonthTaskCompleted }}</p>
                    <a href="/employee/tasks" class="btn btn-primary mt-3">View My Tasks</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/emp_dashboard.js') }}"></script>


@endsection