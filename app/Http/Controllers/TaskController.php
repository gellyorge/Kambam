<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        return view('home', [
            'tasks_todo' => Task::where('status', 'todo')->get(),
            'tasks_in_progress' => Task::where('status', 'in_progress')->get(),
            'tasks_done' => Task::where('status', 'done')->get(),
        ]);
    }

    public function create()
    {
        return view('form');
    }

    public function store(StoreTaskRequest $request)
    {
        Task::create($request->validated());

        return redirect()->route('tasks.index')->with('success', 'Task created successfully!');
    }

    public function edit(Task $task)
    {
        return view('form', ['task' => $task]);
    }

    public function update(UpdateTaskRequest $request, Task $task)
    {
        $task->update($request->validated());

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully!');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully!');
    }

    public function updateStatus(Request $request)
    {
        $task = Task::find($request->id);
        if ($task && in_array($request->status, ['todo','in_progress','done'])) {
            $task->status = $request->status;
            $task->save();
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false], 404);
    }
}
