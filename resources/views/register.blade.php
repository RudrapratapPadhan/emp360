@extends('base')

@section('mainblock')
<div class="container mt-5">
    <div class="row justify-content-center align-items-center">
        <div class="col-lg-10">
            <div id="form-container" class="border border-1 border-primary rounded shadow p-4 bg-white">
                <h3 class="text-center mb-4">Employee Registration</h3>
                
                @if(isset($msg) && $msg != "")
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ $msg }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if(isset($error) && $error != "")
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ $error }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                
                <form action="/register" method="post" id="registration-form">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">Enter your name</label>
                            <input class="form-control border border-2 border-primary" type="text" name="name" required> 
                        
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Enter your email</label>
                            <input class="form-control border-2 border-primary" type="email" name="email" required>
                            <p id="email-error"></p> 
                        </div>

                        <div class="col-md-4">
                            <label class="formlet-label">Enter your mobile number</label>
                            <input class="form-control border-2 border-primary" type="tel" name="mobile" required> 
                            <p id="mobile-error"></p>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Enter your age</label>
                            <input class="form-control border-2 border-primary" type="number" name="age" required> 
                            <p id="age-error"></p>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Enter your gender</label>
                            <input class="form-control border-2 border-primary" type="radio" name="gender" value="male" required> Male
                            <input class="form-control border-2 border-primary" type="radio" name="gender" value="female" required> Female
                            <p id="gender-error"></p>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Enter your DOB</label>
                            <input class="form-control border-2 border-primary" type="date" name="dob" required> 
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Enter your father name</label>
                            <input class="form-control border-2 border-primary" type="text" name="fname" required> 
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Enter mother name</label>
                            <input class="form-control border-2 border-primary" type="text" name="mname" required>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Enter your permanent address</label>
                            <input class="form-control border-2 border-primary" type="text" name="paddress" required>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Enter your current address</label>
                            <input class="form-control border-2 border-primary" type="text" name="caddress" required>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Password</label>
                            <input class="form-control border-2 border-primary" type="password" name="password" minlength="8" required>
                            <small class="text-muted">Minimum 8 characters</small>
                            <p id="password-error"></p>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Confirm Password</label>
                            <input class="form-control border-2 border-primary" type="password" name="confirm_password" required>
                            <p id="confirm-password-error"></p>
                        </div>
                    </div>

                    <div class="text-center mt-4">
                        <button class="btn btn-primary btn-lg px-5" type="submit">Register</button> 
                        <div class="mt-2">Already registered? <a href="/login">Login here</a></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/register.js') }}"></script>
@endsection