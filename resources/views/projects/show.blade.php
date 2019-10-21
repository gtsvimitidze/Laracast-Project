@extends('layout')


@section('content')
    <h1> {{ $project->title }} </h1>

    <div>
        {{ $project->description }}
    </div>
    
    <p>
        <a href="/projects/{{ $project->id }}/edit">Edit</a>
    </p>

    @if ($project->tasks->count())
        <div style="border: 1px solid grey; padding: 10px" class="box">
            @foreach($project->tasks as $task) 
                <div>
                    <form action="/tasks/{{ $task->id }}" method="POST">

                        @method('PATCH')
                        @csrf

                        <label for="completed" class="checkbox">
                            <input type="checkbox" name="completed" onChange="this.form.submit()" {{ $task->completed ? 'checked' : ''}}>
                            {{ $task->description }}
                        </label>
                    </form>
                </div>
            @endforeach
        </div>
    @endif

    <form action="/projects/{{ $project->id }}/tasks" method="POST"  style="border: 1px solid grey; padding: 10px" class="box">
        @csrf
        <div class="field">
            <label class="label" for="">New Task</label>

            <div class="control" >
                <input type="text" class="input" name="description" placeholder="New Task" value="{{ old('description') }}" required>
            </div>
        </div>
        
        <div class="field">

            <div class="control" >
                <button type="submit"> Add Task</button>
            </div>
        </div>
        
        @include('errors')

    </form>


@endsection