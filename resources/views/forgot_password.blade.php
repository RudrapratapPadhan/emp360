@extends('base')
@section('title')
Forgot Password
@endsection
@section('mainblock')
<div class="container"> 
    <div class="row justify-content-center align-items-center min-vh-100">
        <div class="col-md-5 col-lg-4">
            <div class="card shadow-lg border-0">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <h2 class="fw-bold text-primary">Forgot Password</h2>
                        <p class="text-muted">Enter your email to reset your password</p>
                    </div>
                    <form action="/forgot-password" method="post">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control form-control-lg" id="email" name="email" placeholder="Enter your email" required>
                        </div>

                        <div class="mb-3">
                            <label for="new_password" class="form-label">New Password</label>
                            <input type="password" class="form-control form-control-lg" id="new_password" name="new_password" placeholder="Enter your new password" required>
                        </div>

                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-primary btn-lg">Reset Password</button>
                        </div>

                        <div class="text-center">
                            <a href="/login" class="text-decoration-none text-muted">Back to Login</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection