@extends('base')

@section('title')
My Profile
@endsection

@section('mainblock')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow mb-4">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">
                        <i class="bi bi-person-circle"></i> My Profile
                    </h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Profile Picture Placeholder -->
                        <div class="col-md-3 text-center mb-3">
                            <div class="bg-primary text-white rounded-circle mx-auto d-flex align-items-center justify-content-center" style="width: 150px; height: 150px;">
                                <i class="bi bi-person-fill" style="font-size: 80px;"></i>
                            </div>
                            <h5 class="mt-3">{{ $employee->name }}</h5>
                            <p class="text-muted">
                                @if($employee->role == 'admin')
                                    <span class="badge bg-danger">Admin</span>
                                @else
                                    <span class="badge bg-info">Employee</span>
                                @endif
                            </p>
                        </div>

                        <div class="col-md-9">
                            <h5 class="text-primary mb-3">Personal Information</h5>
                            
                            <div class="row mb-2">
                                <div class="col-md-4">
                                    <strong>Full Name:</strong>
                                </div>
                                <div class="col-md-8">
                                    {{ $employee->name }}
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-md-4">
                                    <strong>Email:</strong>
                                </div>
                                <div class="col-md-8">
                                    <i class="bi bi-envelope"></i> {{ $employee->email }}
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-md-4">
                                    <strong>Mobile:</strong>
                                </div>
                                <div class="col-md-8">
                                    <i class="bi bi-phone"></i> {{ $employee->mobile ?? 'N/A' }}
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-md-4">
                                    <strong>Age:</strong>
                                </div>
                                <div class="col-md-8">
                                    {{ $employee->age ?? 'N/A' }} years
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-md-4">
                                    <strong>Date of Birth:</strong>
                                </div>
                                <div class="col-md-8">
                                    <i class="bi bi-calendar"></i> 
                                    @if($employee->dob)
                                        {{ \Carbon\Carbon::parse($employee->dob)->format('d M Y') }}
                                    @else
                                        N/A
                                    @endif
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-md-4">
                                    <strong>Role:</strong>
                                </div>
                                <div class="col-md-8">
                                    {{ ucfirst($employee->role) }}
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-md-4">
                                    <strong>Member Since:</strong>
                                </div>
                                <div class="col-md-8">
                                    <i class="bi bi-clock-history"></i> {{ $employee->created_at->format('d M Y') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow mb-4">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">
                        <i class="bi bi-people"></i> Family Information
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="fw-bold text-secondary">Father's Name:</label>
                            <p>{{ $employee->father_name ?? 'Not provided' }}</p>
                        </div>
                        <div class="col-md-6">
                            <label class="fw-bold text-secondary">Mother's Name:</label>
                            <p>{{ $employee->mother_name ?? 'Not provided' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow mb-4">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0">
                        <i class="bi bi-geo-alt"></i> Address Information
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="fw-bold text-secondary">Permanent Address:</label>
                            <div class="bg-light p-3 rounded">
                                <p class="mb-0">{{ $employee->permanent_address ?? 'Not provided' }}</p>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="fw-bold text-secondary">Current Address:</label>
                            <div class="bg-light p-3 rounded">
                                <p class="mb-0">{{ $employee->current_address ?? 'Not provided' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if($employee->role == 'employee')
            <div class="card shadow mb-4">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0">
                        <i class="bi bi-graph-up"></i> My Task Statistics
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-md-3">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h3 class="text-primary">{{ $totalTasks ?? 0 }}</h3>
                                    <p class="mb-0">Total Tasks</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h3 class="text-secondary">{{ $pendingTasks ?? 0 }}</h3>
                                    <p class="mb-0">Pending</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h3 class="text-info">{{ $inProgressTasks ?? 0 }}</h3>
                                    <p class="mb-0">In Progress</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h3 class="text-success">{{ $completedTasks ?? 0 }}</h3>
                                    <p class="mb-0">Completed</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <div class="card shadow">
                <div class="card-body">
                    <div class="d-grid gap-2">
                        @if($employee->role == 'employee')
                            <a href="/employee/dashboard" class="btn btn-primary btn-lg">
                                <i class="bi bi-speedometer2"></i> Go to Dashboard
                            </a>
                            <a href="/employee/tasks" class="btn btn-success btn-lg">
                                <i class="bi bi-list-task"></i> View My Tasks
                            </a>
                        @else
                            <a href="/admin/dashboard" class="btn btn-primary btn-lg">
                                <i class="bi bi-speedometer2"></i> Go to Admin Dashboard
                            </a>
                        @endif
                        
                        <button class="btn btn-warning btn-lg" data-bs-toggle="modal" data-bs-target="#changePasswordModal">
                            <i class="bi bi-key"></i> Change Password
                        </button>
                        
                        <form action="/logout" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-lg w-100">
                                <i class="bi bi-box-arrow-right"></i> Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="changePasswordModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h5 class="modal-title">
                    <i class="bi bi-key"></i> Change Password
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="/employee/change-password" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="currentPassword" class="form-label">Current Password *</label>
                        <input type="password" class="form-control" id="currentPassword" name="current_password" required>
                    </div>
                    <div class="mb-3">
                        <label for="newPassword" class="form-label">New Password *</label>
                        <input type="password" class="form-control" id="newPassword" name="new_password" minlength="8" required>
                        <small class="text-muted">Minimum 8 characters</small>
                    </div>
                    <div class="mb-3">
                        <label for="confirmPassword" class="form-label">Confirm New Password *</label>
                        <input type="password" class="form-control" id="confirmPassword" name="confirm_password" required>
                    </div>
                    <div class="alert alert-info">
                        <small>
                            <i class="bi bi-info-circle"></i> 
                            Your password must be at least 8 characters long.
                        </small>
                    </div>
                    <div class="alert alert-warning">
                        <small>
                            <i class="bi bi-exclamation-triangle"></i> 
                            <strong>Forgot your current password?</strong> 
                            <a href="/forgot-password" class="alert-link">Click here to reset it</a>
                        </small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-warning">Change Password</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection