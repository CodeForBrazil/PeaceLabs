@extends('frontend.layouts.master')

@section('content')

  <div class="main container-fluid">
    <h2>Criar um projeto</h2>
 
    {!! Form::model(new App\Models\Project, ['route' => ['projects.store']]) !!}
        @include('frontend/projects/partials/_form', ['submit_text' => 'Criar um projeto'])
    {!! Form::close() !!}
  </div>
    
@endsection
