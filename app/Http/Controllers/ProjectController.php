<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = auth()->user()->projects;
    return view('projects.index', compact('projects'));
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
    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255'
    ]);

    auth()->user()->projects()->create($request->all());

    return redirect()->route('projects.index');
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
    public function edit($id)
{
    $project = Project::where('id', $id)
        ->where('user_id', auth()->id())
        ->firstOrFail();

    return view('projects.edit', compact('project'));
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    $project = Project::where('id', $id)
        ->where('user_id', auth()->id())
        ->firstOrFail();

    $request->validate([
        'name' => 'required|string|max:255'
    ]);

    $project->update($request->all());

    return redirect()->route('projects.index');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
{
    $project = Project::where('id', $id)
        ->where('user_id', auth()->id())
        ->firstOrFail();

    $project->delete();

    return back();
}
}
