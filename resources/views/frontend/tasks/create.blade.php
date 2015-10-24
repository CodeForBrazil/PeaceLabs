@extends('frontend.layouts.master')

@section('content')

  <div class="main container-fluid">
    <h2>Criar uma tarefa para o projet <em>{{ $project->name }}</em></h2>
 
    {!! Form::model(new App\Models\Task, ['route' => ['projects.tasks.store', $project->slug], 'class'=>'']) !!}
        @include('frontend/tasks/partials/_form', ['submit_text' => 'Criar a tarefa'])
    {!! Form::close() !!}
  </div>
    
@endsection
