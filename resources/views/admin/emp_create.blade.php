<!-- filepath: resources/views/emp_create.blade.php -->

@extends('base')

@section('mainblock')
<div class="container mt-5">
    <div class="row justify-content-center align-items-center">
        <div class="col-lg-10">
            <div class="border border-1 border-primary rounded shadow p-4 bg-white">
                <h3 class="text-center mb-4">Add New Employee</h3>
                
                @if(isset($msg) && $msg != "")
                    <div class="alert alert-success">{{ $msg }}</div>
                @endif

                @if(isset($error) && $error != "")
                    <div class="alert alert-danger">{{ $error }}</div>
                @endif
                
                <form action="/employees/create" method="post">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">Name</label>
                            <input class="form-control" type="text" name="name" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Email</label>
                            <input class="form-control" type="email" name="email" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Mobile</label>
                            <input class="form-control" type="tel" name="mobile" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Age</label>
                            <input class="form-control" type="number" name="age" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">DOB</label>
                            <input class="form-control" type="date" name="dob" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Father Name</label>
                            <input class="form-control" type="text" name="fname" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Mother Name</label>
                            <input class="form-control" type="text" name="mname" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Permanent Address</label>
                            <input class="form-control" type="text" name="paddress" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Current Address</label>
                            <input class="form-control" type="text" name="caddress" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Password</label>
                            <input class="form-control" type="password" name="password" minlength="8" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Confirm Password</label>
                            <input class="form-control" type="password" name="confirm_password" required>
                        </div>
                    </div>

                    <div class="text-center mt-4">
                        <button class="btn btn-primary px-5" type="submit">Create Employee</button>
                        <a href="/admin/dashboard" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection