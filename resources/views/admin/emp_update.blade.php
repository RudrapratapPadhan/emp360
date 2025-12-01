@extends('base')

@section('mainblock')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="border border-primary rounded shadow p-4 bg-white">
                <h3 class="text-center mb-4">Update Employee</h3>
                
                @if(isset($msg) && $msg != "")
                    <div class="alert alert-success">{{ $msg }}</div>
                @endif

                @if(isset($error) && $error != "")
                    <div class="alert alert-danger">{{ $error }}</div>
                @endif
                
                <form action="/employees/update/{{ $emp->id }}" method="post">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">Name</label>
                            <input class="form-control" type="text" name="name" value="{{ $emp->name }}" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Email</label>
                            <input class="form-control" type="email" name="email" value="{{ $emp->email }}" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Mobile</label>
                            <input class="form-control" type="tel" name="mobile" value="{{ $emp->mobile }}" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Age</label>
                            <input class="form-control" type="number" name="age" value="{{ $emp->age }}" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">DOB</label>
                            <input class="form-control" type="date" name="dob" value="{{ $emp->dob }}" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Father Name</label>
                            <input class="form-control" type="text" name="fname" value="{{ $emp->father_name }}" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Mother Name</label>
                            <input class="form-control" type="text" name="mname" value="{{ $emp->mother_name }}" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Permanent Address</label>
                            <input class="form-control" type="text" name="paddress" value="{{ $emp->permanent_address }}" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Current Address</label>
                            <input class="form-control" type="text" name="caddress" value="{{ $emp->current_address }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">New Password (leave blank to keep current)</label>
                            <input class="form-control" type="password" name="password" minlength="8">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Confirm Password</label>
                            <input class="form-control" type="password" name="confirm_password">
                        </div>
                    </div>

                    <div class="text-center mt-4">
                        <button class="btn btn-primary px-5" type="submit">Update Employee</button>
                        <a href="/admin/dashboard" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection