<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Models\Task;
use App\Models\Project;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {

    $projects = auth()->user()->projects;

    $baseTasks = Task::whereHas('project', function ($query) {
        $query->where('user_id', auth()->id());
    });

    return view('dashboard', [
        'projectCount' => $projects->count(),
        'taskCount' => $baseTasks->count(),
        'todo' => (clone $baseTasks)->where('status', 'To Do')->count(),
        'inProgress' => (clone $baseTasks)->where('status', 'In Progress')->count(),
        'done' => (clone $baseTasks)->where('status', 'Done')->count(),
    ]);

})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::resource('projects', ProjectController::class);
    Route::get('/projects/{project}/tasks', [TaskController::class, 'index'])->name('tasks.index');
    Route::post('/projects/{project}/tasks', [TaskController::class, 'store'])->name('tasks.store');
    Route::get('/projects/{project}/tasks/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
    Route::put('/projects/{project}/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');
    Route::delete('/projects/{project}/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');
});

require __DIR__.'/auth.php';
