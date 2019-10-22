<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Task;
use App\Project;

class ProjectTasksController extends Controller
{
    public function store(Project $project) {

        $project->addTask(
            request()->validate([
                'description' => ['required', 'min:3', 'max:255']
            ])
        );

        // Task::create([
        //     'project_id' => $project->id,
        //     'description' => request('description')
        // ]);

        return back();
    }
    /*public function update(Task $task) {
        // dd($task);

        // request()->has('completed') ? $task->complete() : $task->incomplete();

        // $task->complete(request()->has('completed'));

        // $task->update([
        //     'completed' => request()->has('completed')
        // ]);

        $method = request()->has('completed') ? 'complete' : 'incomplete';

        $task->$method();

        return back();
    }*/
}
