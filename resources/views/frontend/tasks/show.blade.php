@extends('frontend.layouts.master')

@section('content')

  <div class="main container-fluid">
    {!! Form::open(array('class' => 'form-inline', 'method' => 'DELETE', 'route' => array('projects.tasks.destroy', $project->slug, $task->slug))) !!}
	    <h2>
	        {!! link_to_route('projects.show', $project->name, [$project->slug]) !!} -
	        {{ $task->name }}
			{!! link_to_route('projects.tasks.edit', 'Editar', array($project->slug, $task->slug), array('class' => 'btn btn-info btn-xs')) !!}
			{!! Form::submit('Deletar', array('class' => 'btn btn-danger btn-xs')) !!}
	    </h2>
 	{!! Form::close() !!}
 
    {{ $task->description }}

      <!-- COMMENT -->
      <div class="comments">

		@include('frontend/includes/comments')

      </div>
      <!-- /COMMENT -->
    
  </div>
    
@endsection
