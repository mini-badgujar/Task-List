@extends('layouts.app')


@section('title')
    <h1>
        List of Task
    </h1>

@endsection
{{-- 
@if(count($tasks)>0)
    <div>These are tasks title: </div>
    @foreach($tasks as $task)
        <div>{{$task->title}}</div>
    @endforeach


@else
    <div>There are no tasks!</div>
@endif

<br>

@forelse($tasks as $task)
    <div>{{$task->title}}</div>
@empty
    <p>There are no records</p>
@endforelse

<br> --}}

@section('content')
@foreach($tasks as $task)
    <div>
        <a href="{{ route('tasks.show', ['id' => $task->id ])}}">{{ $task->title }}</a>
    </div>
@endforeach
@endsection