<?php

namespace App\Http\Controllers\Api;

use App\Events\TaskStatusChanged;
use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Rules\ValidTaskStatus;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        return response()->json(Task::all());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $task = Task::create([
            'title' => $data['title'],
            'description' => $data['description'],
        ]);

        return response()->json($task);
    }

    public function update(Request $request, Task $task)
    {
        $data = $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'status' => ['nullable', new ValidTaskStatus()],
        ]);

        $task->update([
            'title' => $data['title'] ?? $task->title,
            'description' => $data['description'] ?? $task->description,
            'status' => $data['status'] ?? $task->status,
        ]);

        return response()->json($task);
    }

    public function updateStatus(Request $request, Task $task)
    {
        $data = $request->validate([
            'status' => ['required', new ValidTaskStatus()],
        ]);

        $oldStatus = $task->status->value ?? $task->status;

        $task->update(['status' => $data['status']]);

        event(new TaskStatusChanged($task, $oldStatus, $data['status']));

        return response()->json($task);
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return response()->noContent();
    }


}
