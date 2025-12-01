@extends('base')

@section('title')
Update Task Status
@endsection

@section('mainblock')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Update Task Status</h4>
                </div>
                <div class="card-body">
                    <div class="bg-light p-3 rounded mb-4">
                        <h5 class="text-primary mb-3">Task Details</h5>
                        
                        <div class="row mb-2">
                            <div class="col-md-4"><strong>Task ID:</strong></div>
                            <div class="col-md-8">#{{ $task->id }}</div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-md-4"><strong>Title:</strong></div>
                            <div class="col-md-8">{{ $task->title }}</div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-md-4"><strong>Description:</strong></div>
                            <div class="col-md-8">{{ $task->description ?? 'No description' }}</div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-md-4"><strong>Priority:</strong></div>
                            <div class="col-md-8">
                                @if($task->priority == 'urgent')
                                    <span class="badge bg-danger">Urgent</span>
                                @elseif($task->priority == 'high')
                                    <span class="badge bg-warning">High</span>
                                @elseif($task->priority == 'medium')
                                    <span class="badge bg-info">Medium</span>
                                @else
                                    <span class="badge bg-secondary">Low</span>
                                @endif
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-md-4"><strong>Current Status:</strong></div>
                            <div class="col-md-8">
                                @if($task->status == 'completed')
                                    <span class="badge bg-success">Completed</span>
                                @elseif($task->status == 'in_progress')
                                    <span class="badge bg-primary">In Progress</span>
                                @else
                                    <span class="badge bg-secondary">Pending</span>
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4"><strong>Due Date:</strong></div>
                            <div class="col-md-8">{{ $task->due_date ?? 'No deadline' }}</div>
                        </div>
                    </div>

                    <hr>

                    <h5 class="text-primary mb-3">Change Task Status</h5>
                    
                    <form action="/employee/task/update/{{ $task->id }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label for="status" class="form-label fw-bold">Select New Status: *</label>
                            <select name="status" id="status" class="form-select form-select-lg" required>
                                <option value="">-- Choose Status --</option>
                                
                                @if($task->status == 'pending')
                                    <option value="in_progress">In Progress</option>
                                    <option value="completed">Completed</option>
                                @elseif($task->status == 'in_progress')
                                    <option value="completed">Completed</option>
                                @else
                                    <option disabled>Task is already completed</option>
                                @endif
                            </select>
                        </div>

                        <div class="d-grid gap-2">
                            @if($task->status != 'completed')
                                <button type="submit" class="btn btn-primary btn-lg">Update Status</button>
                            @else
                                <button type="button" class="btn btn-success btn-lg" disabled>Task Already Completed</button>
                            @endif
                            
                            <a href="/employee/tasks" class="btn btn-secondary">Back to My Tasks</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection