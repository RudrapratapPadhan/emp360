<!-- filepath: e:\employee_management_system\resources\views\base.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>EMS || @yield('title')</title>
    <link href="{{ asset('bootstrap/bootstrap.min.css') }}" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="/"><img src="{{ asset('images/emp360.png') }}" height="40" width="50"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="/">Home</a>
        </li>
        
        @auth
          @if(Auth::user()->role === 'admin')
            <li class="nav-item">
              <a class="nav-link" href="/admin/dashboard">Dashboard</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Manage Employees
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="/employees">View All Employees</a></li>
                <li><a class="dropdown-item" href="/employees/create">Add Employee</a></li>
              </ul>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Tasks
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="/tasks/create">Assign Task</a></li>
                <li><a class="dropdown-item" href="/tasks">View All Tasks</a></li>
              </ul>
            </li>
          @elseif(Auth::user()->role === 'employee')
            <li class="nav-item">
              <a class="nav-link" href="/employee/dashboard">Dashboard</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/employee/tasks">My Tasks</a>
            </li>
          @endif

          <li class="nav-item dropdown ms-auto">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              {{ Auth::user()->name }}
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
              <li><a class="dropdown-item" href="/employee/profile">
                <i class="bi bi-person-circle"></i> My Profile
              </a></li>
              <li><hr class="dropdown-divider"></li>
              <li>
                <form action="/logout" method="POST" class="d-inline">
                  @csrf
                  <button type="submit" class="dropdown-item text-danger">Logout</button>
                </form>
              </li>
            </ul>
          </li>
        @else
          <li class="nav-item ms-auto">
            <a class="nav-link" href="/login">Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link btn   ms-2" href="/register">Register</a>
          </li>
        @endauth
      </ul>
    </div>
  </div>
</nav>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@yield('mainblock')

<script src="{{ asset('bootstrap/bootstrap.bundle.min.js') }}"></script>
</body>
</html>