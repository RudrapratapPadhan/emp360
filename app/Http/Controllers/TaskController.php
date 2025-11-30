<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;
use Exception;

class TaskController extends Controller
{
    function listTasks(){
        $tasks = Task::with(['user','creator'])->orderBy('created_at','desc')->paginate(15);
        return view('tasks.list_all', compact('tasks'));   
    }

    function createTasks(){
        $employees = User::where('role','employee')->get();
        return view('tasks.create', compact('employees'));
    }

    function storeTasks(){
        $msg = '';
        $error = '';
        if(request()->isMethod('POST')){
            try{
            $task = new Task;
            $task->title = request('title');
            $task->description = request('description');
            $task->user_id = request('employee_id');
            $task->created_by = Auth::id();
            $task->priority = request('priority');
            $task->status = 'pending';
            $task->due_date = request('due_date');
            $task->save();
            return redirect('tasks')->with('msg','Task created successfully!');
            }catch(Exception $e){
                $error = $e->getMessage();
                $employees = User::where('role','employee')->get();
                return view('tasks.create', compact('msg','error','employees'));
            }

            $employees = User::where('role','employee')->get();
            return view('tasks.create', compact('msg','error','employees'));
            
            
            
        }
    }


    function editTasks($id){
        $task = Task::find($id);
        $employees = User::where('role','employee')->get();

        $msg = '';
        $error = '';
        return view('tasks.update', compact('task','employees','msg','error'));
    }

    function updateTasks($id){
        $task = Task::find($id);
        $msg = '';
        $error = '';

        if(!$task){
            return redirect('tasks')->with('error','Task not found');
        }

        if(request()->isMethod('POST')){
            try{
                $task->title = request('title');
                $task->description = request('description');
                $task->user_id = request('employee_id');
                $task->priority = request('priority');
                $task->status = request('status');
                $task->due_date = request('due_date');

                if($task->status == 'completed'){
                    $task->completed_at = now();
                }

                $task->save();
                return redirect('tasks')->with('success','Task updated successfully!');
            }catch(Exception $e){
                $error = $e->getMessage();
                $employees = User::where('role','employee')->get();
                return view('tasks.update', compact('task','employees','msg','error'));
            }
        }

        $employees = User::where('role','employee')->get();
        return view('tasks.update', compact('task','employees','msg','error'));
    }


    function deleteTasks($id){
        $task = Task::find($id);
        if($task){
            $task->delete();
            return redirect('admin/dashboard')->with('success','Task deleted successfully!');
        }else{
            return redirect('tasks')->with('error','Task not found');
        }
    }
}
