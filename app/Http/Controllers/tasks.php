<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\task;
use App\Models\more;
use Illuminate\Support\Facades\Auth;

class tasks extends Controller
{
    function index(){
        $user_id = Auth::id();
        $tasks = task::where('user_id', $user_id)->get();
        $more = More::whereIn('task_id', $tasks->pluck('id'))->get();
        return view('frontend.index', compact('tasks', 'more'));
    }
    
    function create(Request $request){
        $validatedData = $request->validate([
            'task' => 'required|string',
        ]);
    
        $user_id = Auth::id();
        $task = new task();
        $task->task = $validatedData['task'];
        $task->user_id = $user_id;
        $task->save();

        //return response()->json(['success' => true]);
        return response()->redirectTo(route('tasks_page'));

    }
    function delete($taskId){
        $task = task::find($taskId);
        if(!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }

        if($task->user_id != Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $task->delete();
        return response()->json(['message' => 'Task deleted successfully']);
    }
    public function pinTask($taskId)
    {
    $task = Task::find($taskId);
    if (!$task) {
        return response()->json(['message' => 'Task not found'], 404);
    }

    $more = More::where('task_id', $taskId)->first();

    if ($more) {
        $more->pin = 'yes';
        $more->save();
    } else {
        More::create([
            'done' => 'no',
            'pin' => 'yes',
            'task_id' => $taskId
        ]);
    }

    return response()->json(['message' => 'Task pinned successfully']);
    }

    public function updatePinStatus(Request $request, $taskId)
    {
        $task = Task::find($taskId);
        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }
    
        $more = More::where('task_id', $taskId)->where('pin', 'yes')->first();

        if ($more) {
            $more->pin = 'yes';
            $more->done = 'yes'; // Assuming you want to set 'done' to 'yes' when updating pin status
            $more->save();
        } else {
            More::create([
                'done' => 'yes',
                'pin' => 'no', // Assuming you want to set 'pin' to 'yes' when creating a new record
                'task_id' => $taskId
            ]);
        }

    
        return response()->json(['message' => 'Task pinned successfully']);
    }
    
    public function pined()
    {
        $pinnedTasks = more::where('pin', 'yes')->get();
        $tasks = [];

        foreach ($pinnedTasks as $pinTask) {
            $task = task::find($pinTask->task_id);
            if ($task) {
                $tasks[] = $task;
            }
        }

        return response()->json($tasks);
    }

}
