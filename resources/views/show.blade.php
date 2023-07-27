@extends('layouts.app')

@section('title', $task->title)

@section('content')
<p>{{$task->description}}</p>

@if($task->long_description)
    <p>{{$task->long_description}}</p>
@endif

<p>{{$task->created_at}}</p>
<p>{{$task->updated_at}}</p>

<p>
    @if ($task->completed)
        Task completed
    @else
        Task not completed
    @endif
</p>

<div>
    <a href="{{route('tasks.edit',['task'=>$task->id])}}">Edit Task</a>
</div>
<div>
    <form method="POST" action="{{route('task.toggle-complete', ['task'=>$task->id])}}">
        @csrf
        @method('PUT')
        <button type="submit">
            Mark as {{ $task->completed ? 'not completed':'completed'}}
        </button>
    </form>
</div>
<div>
    <form action="{{route('task.destroy', ['task'=>$task->id])}}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit">DELETE</button>
    </form>
</div>
@endsection