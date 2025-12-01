@extends('base')

@section('title')
View Task Details
@endsection

@section('mainblock')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-info text-white">
                    <h4>Task Details</h4>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="fw-bold">Task ID:</label>
                            <p>{{ $task->id }}</p>
                        </div>
                        <div class="col-md-6">
                            <label class="fw-bold">Priority:</label>
                            <p>
                                @if($task->priority == 'urgent')
                                    <span class="badge bg-danger">Urgent</span>
                                @elseif($task->priority == 'high')
                                    <span class="badge bg-warning">High</span>
                                @elseif($task->priority == 'medium')
                                    <span class="badge bg-info">Medium</span>
                                @else
                                    <span class="badge bg-secondary">Low</span>
                                @endif
                            </p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="fw-bold">Status:</label>
                            <p>
                                @if($task->status == 'completed')
                                    <span class="badge bg-success">Completed</span>
                                @elseif($task->status == 'in_progress')
                                    <span class="badge bg-primary">In Progress</span>
                                @else
                                    <span class="badge bg-secondary">Pending</span>
                                @endif
                            </p>
                        </div>
                        <div class="col-md-6">
                            <label class="fw-bold">Due Date:</label>
                            <p>{{ $task->due_date ?? 'No deadline' }}</p>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="fw-bold">Title:</label>
                        <p>{{ $task->title }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="fw-bold">Description:</label>
                        <p>{{ $task->description }}</p>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="fw-bold">Assigned By:</label>
                            <p>{{ $task->creator->name ?? 'Admin' }}</p>
                        </div>
                        <div class="col-md-6">
                            <label class="fw-bold">Assigned On:</label>
                            <p>{{ $task->created_at->format('d M Y, h:i A') }}</p>
                        </div>
                    </div>

                    @if($task->status == 'completed' && $task->completed_at)
                    <div class="mb-3">
                        <label class="fw-bold">Completed On:</label>
                        <p>{{ $task->completed_at->format('d M Y, h:i A') }}</p>
                    </div>
                    @endif

                    <hr>

                    <div class="d-grid gap-2">
                        @if($task->status != 'completed')
                            <a href="/employee/task/{{ $task->id }}" class="btn btn-primary">Update Status</a>
                        @endif
                        <a href="/employee/tasks" class="btn btn-secondary">Back to Tasks</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection