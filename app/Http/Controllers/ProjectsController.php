<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\Services\Twitter;
use Illuminate\Filesystem\Filesystem;

class ProjectsController extends Controller
{
    public function __construct() {
        $this->middleware('auth')->only(['store']); //except([]);
    }
    public function index() {
        
        // $projects = Project::all();
        $projects = Project::where('owner_id', auth()->id())->get();
        return view('projects.index', compact('projects') );

    }
    
    public function create() {
        
        return view('projects.create');
    }

    public function show(Project $project, Twitter $twitter) {
        $this->authorize('view', $project);

        // abort_unless(auth()->user()->owns($project), 403);
        
        // abort_if(\Gate:allows('update', $project), 403)

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

        $attributes = request()->validate([
            'title' => ['required', 'min:3', 'max:255'],
            'description' => ['required', 'min:3', 'max:255']
        ]);
        $attributes['owner_id'] = auth()->id();

        Project::create($attributes);
        
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
