@extends('layout')

@section('title', 'Home')

@section('content')

    <h1>Projects</h1>
    
    <a href="/projects/create">Create New Project</a>

    <ul>
        @foreach($projects as $project)
            <li>
                <a href="/projects/{{ $project->id }}">
                    {{ $project->title }}
                </a>
            </li>
        @endforeach

@endsection