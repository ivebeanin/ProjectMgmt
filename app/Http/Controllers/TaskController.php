<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Project;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, $projectId)
    {
        $project = Project::where('id', $projectId)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $tasks = $project->tasks;

       return view('tasks.index', compact('project', 'tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $projectId)
    {
        $project = Project::where('id', $projectId)
        ->where('user_id', auth()->id())
        ->firstOrFail();

    $request->validate([
        'title' => 'required',
        'status' => 'required|in:To Do,In Progress,Done'
    ]);

    $project->tasks()->create($request->all());

    return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($projectId, $taskId)
{
    $project = Project::where('id', $projectId)
        ->where('user_id', auth()->id())
        ->firstOrFail();

    $task = Task::where('id', $taskId)
        ->where('project_id', $project->id)
        ->firstOrFail();

    return view('tasks.edit', compact('project', 'task'));
    // dd('edit reached', $projectId, $taskId);
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $projectId, $taskId)
{
    $project = Project::where('id', $projectId)
        ->where('user_id', auth()->id())
        ->firstOrFail();

    $task = Task::where('id', $taskId)
        ->where('project_id', $project->id)
        ->firstOrFail();

    $request->validate([
        'title' => 'required|string|max:255',
        'status' => 'required|in:To Do,In Progress,Done',
        'description' => 'nullable',
        'due_date' => 'nullable|date'
    ]);

    $task->update($request->only([
        'title',
        'description',
        'status',
        'due_date'
    ]));

    return redirect()->route('tasks.index', $project->id)
        ->with('success', 'Task updated successfully!');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($projectId, $taskId)
{
    $project = Project::where('id', $projectId)
        ->where('user_id', auth()->id())
        ->firstOrFail();

    $task = Task::where('id', $taskId)
        ->where('project_id', $project->id)
        ->firstOrFail();

    $task->delete();

    return back()->with('success', 'Task deleted!');
}
}
