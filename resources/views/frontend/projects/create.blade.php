@extends('frontend.layouts.master')

@section('content')

  <div class="main container">
    <h2>Criar um projeto</h2>
 
    {!! Form::model(new App\Models\Project, ['route' => ['projects.store'], 'class' => 'form-horizontal', 'files' => TRUE]) !!}
        @include('frontend/projects/partials/_form', ['submit_text' => 'Criar um projeto'])
    {!! Form::close() !!}
  </div>
    
@endsection
