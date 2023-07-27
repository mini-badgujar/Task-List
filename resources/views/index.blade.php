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
<nav class="mb-4" >
    <a href="{{(route('task.create'))}}"
     class="link">
     Add Task</a>
</nav>
    @foreach($tasks as $task)
        <div>
            <a href="{{ route('tasks.show', ['task' => $task->id ])}}"
                @class(['line-through' => $task->completed])>{{ $task->title }}</a>
        </div>
        {{-- @empty
        <div>No Tasks </div> --}}
    @endforeach

    @if ($tasks->count())
        <nav class="mt-1">
            {{ $tasks->links() }}
        </nav>
    @endif
@endsection