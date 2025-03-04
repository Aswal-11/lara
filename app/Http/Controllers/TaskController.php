<?php

namespace App\Http\Controllers;

// Models
use App\Models\Task;

// Requests
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // Show tasks
    public function index(Request $request)
    {
        $showAll = $request->query('showAll', false);
        $tasks = $showAll ? Task::all() : Task::where('is_completed', false)->get();

        return view('tasks', compact('tasks', 'showAll'));
    }

    // Add a new task
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:tasks,title|max:255',
        ]);

        Task::create(['title' => $request->title]);

        return redirect()->route('tasks.index');
    }

    // Toggle task completion
    public function toggleComplete($id)
    {
        $task = Task::findOrFail($id);
        $task->is_completed = !$task->is_completed;
        $task->save();

        return redirect()->route('tasks.index');
    }

    // Delete task
    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully');
    }
}
