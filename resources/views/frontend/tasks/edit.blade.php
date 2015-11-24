@extends('frontend.layouts.master')

@section('content')

  <div class="main container">
    <h2>Editar a tarefa <em>{{ $task->name }}</em></h2>
 
    {!! Form::model($task, ['method' => 'PATCH', 'route' => ['projects.tasks.update', $project->slug, $task->slug]]) !!}
        @include('frontend/tasks/partials/_form', ['submit_text' => 'Salvar'])
    {!! Form::close() !!}
  </div>
    
@endsection
