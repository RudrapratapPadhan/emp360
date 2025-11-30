@extends('base')
@section('title')
My Tasks
@endsection
@section('mainblock')
<div class="container mt-4">
    <div class="d-flex justify-content-between mb-4">
        <h1>My Tasks</h1>
        <a href="/employee/dashboard" class="btn btn-secondary">Back to Dashboard</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif


    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card text-white bg-secondary">
                <div class="card-body text-center">
                    <h5>Pending</h5>
                    <h2>{{ $pendingTasks }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-primary">
                <div class="card-body text-center">
                    <h5>In Progress</h5>
                    <h2>{{ $inProgressTasks }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-success">
                <div class="card-body text-center">
                    <h5>Completed</h5>
                    <h2>{{ $completedTasks }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-info">
                <div class="card-body text-center">
                    <h5>Total Tasks</h5>
                    <h2>{{ $pendingTasks + $inProgressTasks + $completedTasks }}</h2>
                </div>
            </div>
        </div>
    </div>

     <div class="card">
        <div class="card-header bg-primary text-white">
            <h5>All My Tasks</h5>
        </div>
        <div class="card-body p-0">
            <table class="table table-striped mb-0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Priority</th>
                        <th>Status</th>
                        <th>Due Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($tasks) > 0)
                        @foreach($tasks as $task)
                        <tr>
                            <td>{{ $task->id }}</td>
                            <td><strong>{{ $task->title }}</strong></td>
                            <td>{{ substr($task->description, 0, 50) }}...</td>
                            <td>
                                @if($task->priority == 'urgent')
                                    <span class="badge bg-danger">Urgent</span>
                                @elseif($task->priority == 'high')
                                    <span class="badge bg-warning">High</span>
                                @elseif($task->priority == 'medium')
                                    <span class="badge bg-info">Medium</span>
                                @else
                                    <span class="badge bg-secondary">Low</span>
                                @endif
                            </td>
                            <td>
                                @if($task->status == 'completed')
                                    <span class="badge bg-success">Completed</span>
                                @elseif($task->status == 'in_progress')
                                    <span class="badge bg-primary">In Progress</span>
                                @else
                                    <span class="badge bg-secondary">Pending</span>
                                @endif
                            </td>
                            <td>{{ $task->due_date ?? 'No deadline' }}</td>
                            <td>
                                @if($task->status != 'completed')
                                    <a href="/employee/task/{{ $task->id }}" class="btn btn-sm btn-primary">Update Status</a>
                                @else
                                    <span class="text-muted">Completed</span>
                                @endif
                                <a href="/employee/task/view/{{ $task->id }}" class="btn btn-sm btn-info">View</a>
                            </td>
                        </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="7" class="text-center py-4">
                                <p class="text-muted">No tasks assigned yet.</p>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            {{ $tasks->links() }}
        </div>
    </div>
</div>
@endsection