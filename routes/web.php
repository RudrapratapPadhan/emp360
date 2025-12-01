<?php
use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', [EmployeesController::class, 'welcome']);
Route::get('register', [EmployeesController::class, 'Showregister']);
Route::post('register', [EmployeesController::class, 'register']);
Route::get('login', [EmployeesController::class, 'Showlogin']);
Route::post('login', [EmployeesController::class, 'login']);
Route::get('forgot-password', [EmployeesController::class, 'forgotPassword']);
Route::post('forgot-password', [EmployeesController::class, 'forgotPassword']);

Route::middleware(['auth'])->group(function () {
    Route::post('logout', [EmployeesController::class, 'logout']);
    Route::get('employee/dashboard', [EmployeesController::class, 'employee_dashboard']);
    Route::get('employee/tasks', [EmployeesController::class, 'myTasks']);
    Route::get('employee/task/{id}', [EmployeesController::class, 'showUpdateTask']);
    Route::post('employee/task/update/{id}', [EmployeesController::class, 'updateTaskStatus']);
    Route::get('employee/task/view/{id}', [EmployeesController::class, 'viewTask']);
    Route::get('employee/profile', [EmployeesController::class, 'showProfile']);
    Route::post('employee/change-password', [EmployeesController::class, 'changePassword']);
});

Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::get('admin/dashboard', [EmployeesController::class, 'admin_dashboard']);
    Route::get('employees', [EmployeesController::class, 'index']);
    Route::get('employees/create', [EmployeesController::class, 'create']);
    Route::post('employees/create', [EmployeesController::class, 'store']);
    Route::get('/employees/update/{id}', [EmployeesController::class, 'edit']);
    Route::post('/employees/update/{id}', [EmployeesController::class, 'update']);
    Route::post('/employees/delete/{id}', [EmployeesController::class, 'delete']);

    
    Route::get('tasks', [TaskController::class, 'listTasks']);
    Route::get('tasks/create', [TaskController::class, 'createTasks']);
    Route::post('tasks/create', [TaskController::class, 'storeTasks']);
    Route::get('/tasks/update/{id}', [TaskController::class, 'editTasks']);
    Route::post('/tasks/update/{id}', [TaskController::class, 'updateTasks']);
    Route::post('/tasks/delete/{id}', [TaskController::class, 'deleteTasks']);
});
