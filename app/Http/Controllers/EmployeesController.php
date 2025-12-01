<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class EmployeesController extends Controller
{
    public function welcome()
    {
        return view('welcome');
    }

    public function Showregister()
    {
        $msg = '';
        $error = '';

        return view('register', compact('msg', 'error'));
    }

    public function register()
    {
        $msg = '';
        $error = '';

        if (request()->isMethod('POST')) {
            try {
                $password = request('password');
                $confirm_password = request('confirm_password');

                if ($password !== $confirm_password) {
                    $error = 'Password and Confirm Password do not match.';
                    return view('register', compact('msg', 'error'));
                }

                $hashedPassword = Hash::make($password);

                $user = new User;
                $user->name = request('name');
                $user->email = request('email');
                $user->mobile = request('mobile');
                $user->age = request('age');
                $user->dob = request('dob');
                $user->father_name = request('fname');
                $user->mother_name = request('mname');
                $user->permanent_address = request('paddress');
                $user->current_address = request('caddress');
                $user->password = Hash::make($password);
                $user->role = 'employee';
                $user->save();

                return redirect('/login')->with('success', 'Registration successful! Please login.');

            } catch (Exception $e) {
                $error = $e->getMessage();
            }
        }

        return view('register', compact('msg', 'error'));
    }

    public function Showlogin()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        if ($request->isMethod('POST')) {
            $credentials = $request->validate([
                'email' => ['required', 'email'],
                'password' => ['required'],
            ]);

            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                $user = Auth::user();

                if ($user->role === 'admin') {
                    return redirect('/admin/dashboard');
                }

                if ($user->role === 'employee') {
                    return redirect('/employee/dashboard');
                }

                Auth::logout();
                return back()->with('error', 'Invalid user role');
            }

            return back()->with('error', 'Invalid email or password');
        }

        return view('login');
    }

    public function forgotPassword()
    {
        if (request()->isMethod('POST')) {
            $email = request('email');
            $new_password = request('new_password');

            $user = User::where('email', $email)->first();
            if ($user) {
                $user->password = Hash::make($new_password);
                $user->save();

                return redirect('/login')->with('success', 'Password reset successfully! Please login with your new password.');
            } else {
                return back()->with('error', 'Email not found in our records.');
            }
        }

        return view('forgot_password');
    }

    public function admin_dashboard()
    {
        $totalEmployees = User::where('role', 'employee')->count();
        $employee = User::where('role', 'employee')
            ->select('id', 'name', 'email', 'mobile', 'age', 'dob', 'father_name')
            ->paginate(10);

        $totalTasks = Task::count();
        $pendingTasks = Task::where('status', 'pending')->count();
        $completedTasks = Task::where('status', 'completed')->count();

        return view('admin.admin_dashboard', compact('employee', 'totalEmployees', 'totalTasks', 'pendingTasks', 'completedTasks'));
    }

    public function index()
    {
        $employee = User::where('role', 'employee')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('admin.employees_list', compact('employee'));
    }

    public function employee_dashboard()
    {
        $employee = Auth::user();
        $pendingTasks = Task::where('user_id', $employee->id)->where('status', 'pending')->count();
        $completedTasks = Task::where('user_id', $employee->id)->where('status', 'completed')->count();
        $thisMonthTasksAssigned = Task::where('user_id', $employee->id)->whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)->count();
        $thisMonthTaskCompleted = Task::where('user_id', $employee->id)->where('status', 'completed')->whereMonth('completed_at', now()->month)->whereYear('completed_at', now()->year)->count();

        return view('employee.employee_dashboard', compact('employee', 'pendingTasks', 'completedTasks', 'thisMonthTasksAssigned', 'thisMonthTaskCompleted'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Logged out successfully');
    }

    public function create()
    {
        return view('admin.emp_create');
    }

    public function store()
    {
        $msg = '';
        $error = '';

        if (request()->isMethod('POST')) {
            try {
                $password = request('password');
                $confirm_password = request('confirm_password');

                if ($password !== $confirm_password) {
                    $error = 'Passwords do not match.';

                    return view('admin.emp_create', compact('msg', 'error'));
                }

                $user = new User;
                $user->name = request('name');
                $user->email = request('email');
                $user->mobile = request('mobile');
                $user->age = request('age');
                $user->dob = request('dob');
                $user->father_name = request('fname');
                $user->mother_name = request('mname');
                $user->permanent_address = request('paddress');
                $user->current_address = request('caddress');
                $user->password = Hash::make($password);
                $user->role = 'employee';
                $user->save();

                $msg = 'Employee created successfully!';
                return redirect('admin/dashboard')->with('success', $msg);

            } catch (Exception $e) {
                $error = $e->getMessage();
            }
        }

        return view('admin.emp_create', compact('msg', 'error'));
    }

    public function edit($id)
    {
        $emp = User::find($id);
        $msg = '';
        $error = '';

        if (! $emp) {
            return redirect('admin/dashboard')->with('error', 'Employee not found');
        }

        return view('admin.emp_update', compact('emp', 'msg', 'error'));
    }

    public function update($id)
    {
        $msg = '';
        $error = '';
        $emp = User::find($id);

        if (!$emp) {
            return redirect('admin/dashboard')->with('error', 'Employee not found');
        }

        if (request()->isMethod('POST')) {
            try {
                $emp->name = request('name');
                $emp->email = request('email');
                $emp->mobile = request('mobile');
                $emp->age = request('age');
                $emp->dob = request('dob');
                $emp->father_name = request('fname');
                $emp->mother_name = request('mname');
                $emp->permanent_address = request('paddress');
                $emp->current_address = request('caddress');

                if (request('password')) {
                    $password = request('password');
                    $confirm_password = request('confirm_password');

                    if ($password !== $confirm_password) {
                        $error = 'Passwords do not match.';
                        return view('admin.emp_update', compact('emp', 'msg', 'error'));
                    }

                    $emp->password = Hash::make($password);
                }

                $emp->save();
                $msg = 'Employee updated successfully!';
                return redirect('admin/dashboard')->with('success', $msg);

            } catch (Exception $e) {
                $error = $e->getMessage();
            }
        }

        return view('admin.emp_update', compact('emp', 'msg', 'error'));
    }

    public function delete($id)
    {
        $emp = User::find($id);

        if (!$emp) {
            return redirect('admin/dashboard')->with('error', 'Employee not found');
        }

        if ($emp->id === Auth::id()) {
            return redirect('admin/dashboard')->with('error', 'You cannot delete yourself!');
        }

        $emp->delete();
        return redirect('admin/dashboard')->with('success', 'Employee deleted successfully');
    }

    public function myTasks()
    {
        $employee = Auth::user();

        $tasks = Task::where('user_id', $employee->id)->orderBy('created_at', 'desc')->paginate(10);

        $completedTasks = Task::where('user_id', $employee->id)->where('status', 'completed')->count();
        $pendingTasks = Task::where('user_id', $employee->id)->where('status', 'pending')->count();
        $inProgressTasks = Task::where('user_id', $employee->id)->where('status', 'in_progress')->count();

        return view('employee.employee_task', compact('tasks', 'employee', 'pendingTasks', 'completedTasks', 'inProgressTasks'));
    }

    public function showUpdateTask($id)
    {
        $task = Task::find($id);

        if (! $task) {
            return redirect('employee/tasks')->with('error', 'Task Not Found');
        }

        if($task->user_id != Auth::id()) {
            return redirect('employee/tasks')->with('error', 'You cannot update this task');
        }

        return view('employee.employee_update_task', compact('task'));
    }

    public function updateTaskStatus($id)
    {
        $task = Task::find($id);

        if (! $task) {
            return redirect('employee/tasks')->with('error', 'Task Not Found');
        }

        if ($task->user_id != Auth::id()) {
            return redirect('employee/tasks')->with('error', 'You cannot update this task');
        }

        if (request()->isMethod('POST')) {
            $status = request('status');
            $task->status = $status;

            if ($status == 'completed') {
                $task->completed_at = now();
            }

            $task->save();

            return redirect('employee/tasks')->with('success', 'Task status updated 🎉');
        }

        return view('employee.employee_update_task', compact('task'));
    }

    public function viewTask($id)
    {
        $task = Task::with('creator')->find($id);

        if (! $task) {
            return redirect('employee/tasks')->with('error', 'Task not found');
        }

        if ($task->user_id != Auth::id()) {
            return redirect('employee/tasks')->with('error', 'You cannot view this task');
        }

        return view('employee.employee_view_task', compact('task'));
    }

    public function showProfile()
    {
        $employee = Auth::user();

        if ($employee->role == 'employee') {
            $totalTasks = Task::where('user_id', $employee->id)->count();
            $pendingTasks = Task::where('user_id', $employee->id)->where('status', 'pending')->count();
            $inProgressTasks = Task::where('user_id', $employee->id)->where('status', 'in_progress')->count();
            $completedTasks = Task::where('user_id', $employee->id)->where('status', 'completed')->count();

            return view('employee.employee_profile', compact('employee', 'totalTasks', 'pendingTasks', 'inProgressTasks', 'completedTasks'));
        }

        return view('employee.employee_profile', compact('employee'));
    }

    public function changePassword()
    {
        if (request()->isMethod('POST')) {
            $user = Auth::user();

            if (!Hash::check(request('current_password'), $user->password)) {
                return redirect()->back()->with('error', 'Current password is incorrect');
            }

            if (request('new_password') !== request('confirm_password')) {
                return redirect()->back()->with('error', 'New passwords do not match');
            }

            if (strlen(request('new_password')) < 8) {
                return redirect()->back()->with('error', 'Password must be at least 8 characters');
            }

            $user->password = Hash::make(request('new_password'));
            $user->save();

            return redirect()->back()->with('success', 'Password changed successfully! 🎉');
        }

        return redirect('employee/profile');
    }
}