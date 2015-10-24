@extends('frontend.layouts.master')

@section('content')

  <div class="main container-fluid">
    <h2>Editar <em>{{ $project->name }}</em></h2>
 
    {!! Form::model($project, ['method' => 'PATCH', 'route' => ['projects.update', $project->slug]]) !!}
        @include('frontend/projects/partials/_form', ['submit_text' => 'Salvar'])
    {!! Form::close() !!}
  </div>
    
@endsection
