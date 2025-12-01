@extends('base')
@section('title')
Login
@endsection
@section('mainblock')
<div class="container">
    <div class="row justify-content-center align-items-center min-vh-100">
        <div class="col-md-5 col-lg-4">
            <div class="card shadow-lg border-0">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <h2 class="fw-bold text-primary">Welcome Back</h2>
                        <p class="text-muted">Login to Employee Management System</p>
                    </div>

                    <form action="/login" method="post" id="login-form" autocomplete="off">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control form-control-lg" id="email" name="email" placeholder="Enter your email" required>
                            <p id="email-error" class="text-danger small"></p>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control form-control-lg" id="password" name="password" placeholder="Enter your password" required>
                            <p id="password-error" class="text-danger small"></p>
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="remember" name="remember">
                            <label class="form-check-label" for="remember">Remember me</label>
                        </div>

                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-primary btn-lg">Login</button>
                        </div>

                        <div class="text-center">
                            <a href="/forgot-password" class="text-decoration-none text-muted">Forgot Password?</a>
                        </div>

                    </form>

                    <hr class="my-4">

                    <div class="text-center">
                        <p class="text-muted mb-0">Don't have an account? <a href="/register" class="text-primary text-decoration-none fw-bold">Register here</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/login.js') }}"></script>
<script>
document.getElementById('login-form').addEventListener('submit', validateLoginForm);
</script>
@endsection