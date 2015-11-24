@extends('frontend.layouts.master')

@section('content')

  <div class="main container">
	@if ( $project->ismember(auth()->user(),'owner') || access()->hasrole('Administrator') )
      {!! Form::open(array('class' => 'form-inline', 'method' => 'DELETE', 'route' => array('projects.tasks.destroy', $project->slug, $task->slug))) !!}
 	@endif
	    <h2>
	        {!! link_to_route('projects.show', $project->name, [$project->slug]) !!} -
	        {{ $task->name }}
			@if ( $project->ismember(auth()->user()) || access()->hasrole('Administrator') )
				{!! link_to_route('projects.tasks.edit', 'Editar', array($project->slug, $task->slug), array('class' => 'btn btn-info btn-xs')) !!}
			@endif
			@if ( $project->ismember(auth()->user(),'owner') || access()->hasrole('Administrator') )
				{!! Form::submit('Deletar', array('class' => 'btn btn-danger btn-xs')) !!}
			@endif
	    </h2>
	@if ( $project->ismember(auth()->user(),'owner') || access()->hasrole('Administrator') )
 	  {!! Form::close() !!}
 	@endif
 
    <div class="description jumbotron">
    	{!! nl2br(e($task->description)) !!}
	</div>
	
      <!-- COMMENT -->
      <div class="comments">

		@include('frontend/includes/comments')

      </div>
      <!-- /COMMENT -->
    
  </div>
    
@endsection
