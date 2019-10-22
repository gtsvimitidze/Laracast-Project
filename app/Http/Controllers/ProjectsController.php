<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\Services\Twitter;
use Illuminate\Filesystem\Filesystem;

class ProjectsController extends Controller
{
    public function index() {
        
        $projects = Project::all();
        return view('projects.index', compact('projects') );

    }
    
    public function create() {
        
        return view('projects.create');
    }

    public function show(Project $project, Twitter $twitter) {
        // $twitter = app('Twitter');

        dd($twitter);

        return view('projects.show', compact('project'));
    }

    // public function show(Project $project) {
        
    //     return view('projects.show', compact('project'));
    // }

    public function edit(Project $project) { // example.com/projects/1/edit
        
        return view('projects.edit', compact('project') );

    }

    public function update(Project $project) { // example.com/projects/1/edit

        $attribute = request()->validate([
            'title' => ['required', 'min:3', 'max:255'],
            'description' => ['required', 'min:3', 'max:255']
        ]);
        $project->update($attribute);

        // $project->title = request('title');
        // $project->description = request('description');
        // $project->save();

        return redirect('/projects');

        // dd( request()->all() );
    }

    public function destroy(Project $project) {
        
        $project->delete();
        // dd('hello' . $id );
        return redirect('/projects');
    }

    public function store() {

        $attribute = request()->validate([
            'title' => ['required', 'min:3', 'max:255'],
            'description' => ['required', 'min:3', 'max:255']
        ]);
        Project::create($attribute);
        
        // Project::create([ 
        //     'title' => request('title'),
        //     'description' => request('description'),
        // ]);

        // $project = new Project();
        // $project->title         = request('title');
        // $project->description   = request('description');

        // $project->save();

        return redirect('/projects');
        // return request()->all();
    }
}
