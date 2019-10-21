@extends('layout')

@section('title', 'Home')

@section('content')

    <h1>Create a New Projects</h1>

    <form action="/projects" method="POST">
        {{ csrf_field() }}
        <div>
            <input type="text" name="title" placeholder="Project title" class="{{ $errors->has('title') ? 'is-danger' : '' }}" value={{ old('title') }}>
        </div>
        <div>
            <textarea name="description" placeholder="Project description" id="" cols="30" rows="10" 
                class="{{ $errors->has('description') ? 'is-danger' : '' }}">{{ old('description') }}</textarea>
        </div>
        <div>
            <button type="submit">Create project</button>
        </div>

        @include('errors')

@endsection