<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Task;
use App\Project;

class ProjectTasksController extends Controller
{
    public function store(Project $project) {

        $attributes = request()->validate([
            'description' => ['required', 'min:3', 'max:255']
        ]);
        
        // dd($attributes);
        $project->addTask($attributes);

        // Task::create([
        //     'project_id' => $project->id,
        //     'description' => request('description')
        // ]);

        return back();
    }
    public function update(Task $task) {
        // dd($task);
        $task->update([
            'completed' => request()->has('completed')
        ]);
        return back();
    }
}
