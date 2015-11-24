@extends('frontend.layouts.master')

@section('content')

  <div class="main container">
    <h2>Criar uma tarefa para o projeto <em>{{ $project->name }}</em></h2>
 
    {!! Form::model(new App\Models\Task, ['route' => ['projects.tasks.store', $project->slug], 'class' => 'form-horizontal']) !!}
        @include('frontend/tasks/partials/_form', ['submit_text' => 'Criar a tarefa'])
    {!! Form::close() !!}
  </div>
    
@endsection
