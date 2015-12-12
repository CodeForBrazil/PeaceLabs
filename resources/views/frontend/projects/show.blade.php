@extends('frontend.layouts.master')

@section('content')

    <!-- HEADER PROJECT PROFILE -->
    <section class="col-xs-12 cover" style="background-image: url('{{ $project->cover_url() }}')">

      <!-- LOGO AND TITLE -->
      <div class="container">
        <img class="poster" src="{{ $project->profile_url(['width' => 280, 'height' => 280, 'crop' => 'fill']) }}" alt="{{ $project->name }} logo" />
      </div>
      <div class="row project-title">
        <div class="container">
          <div class="col-xs-12">
          	@role('Administrator')
            {!! Form::open(array('class' => 'form-inline', 'method' => 'DELETE', 'route' => array('projects.destroy', $project->slug))) !!}
	        @endauth
	            <h1>
	            	{{ $project->name }}

			        @if ( $project->ismember(auth()->user(),'owner') || access()->hasrole('Administrator') )
					{!! link_to_route('projects.edit', 'Editar', array($project->slug), array('class' => 'btn btn-info btn-xs')) !!}
			        @endif

		          	@role('Administrator')
					{!! Form::submit('Deletar', array('class' => 'btn btn-danger btn-xs')) !!}
			        @endauth

	            	@if ( !$project->hasliked(auth()->user()) )
						{!! link_to_route('projects.like', 'Curtir', array($project->slug), 
						array('class' => 'btn btn-success btn-xs')) !!}
				    @else
						{!! link_to_route('projects.dislike', 'Descurtir', array($project->slug), 
						array('class' => 'btn btn-default btn-xs')) !!}
				    @endif
	            </h1>
          	@role('Administrator')
			{!! Form::close() !!}
			@endauth

          </div>
        </div>
      </div>
      <!-- /LOGO AND TITLE -->

      <!-- KPIS -->
      <div class="row loves">
        <div class="container">
          <div class="col-xs-12">
            <span class="kpi" title="Likes"><i class="fa fa-heart"></i> <strong>{{ $project->likes->count() }}</strong></span>&nbsp;
            <span class="kpi" title="Views"><i class="fa fa-eye"></i> <strong>{{ $project->viewsCount() }}</strong></span>&nbsp;
            <span class="kpi" title="Participantes"><i class="fa fa-users"></i> <strong>{{ $project->members->count() }}</strong></span>
            <span class="kpi" title="Tarefas"><i class="fa fa-question-circle"></i> <strong>{{ $project->tasks->count() }}</strong></span>
          </div>
        </div>
      </div>
      <!-- /KPIS -->
    </section>
    <!-- /HEADER PROJECT PROFILE -->


    <!-- PROJECT DESCRIPTION -->
    <section class="project-description">
    <!-- MENU PROJECT PAGE -->
      <div class="container">
        <div class="sidebar-project hidden-xs col-sm-3">
          <!--ul class="list-group">
            <li class="list-group-item"><a href="#">Informações</a></li>
            <li class="list-group-item"><a href="#">Atividade</a></li>
            <li class="list-group-item"><a href="#">Contribuidores</a></li>
            <li class="list-group-item"><a href="#">Comentário</a></li>
          </ul>
          <ul class="list-unstyled">
            <li class="link-external"><a href="#">Informações</a></li>
            <li class="link-external"><a href="#">Atividade</a></li>
            <li class="link-external"><a href="#">Contribuidores</a></li>
            <li class="link-external"><a href="#">Comentário</a></li>
          </ul-->
        </div>
		<div id="fb-root"></div>
					<script>(function(d, s, id) {
						var js, fjs = d.getElementsByTagName(s)[0];
							if (d.getElementById(id)) return;
								js = d.createElement(s); js.id = id;
									js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.5";
										fjs.parentNode.insertBefore(js, fjs);
											}(document, 'script', 'facebook-jssdk'));</script>
        <div class="content-project col-sm-9">
          <div class="project-details">
            <ul class="list-inline">
              <li><span class="project-details-label">Data da Criação</span> {{ date('d/m/Y', strtotime($project->created_at)) }}</li>
              <li><span class="project-details-label">Status</span> {{ $project->status }}</li>
              <!--li><span class="project-details-label">Localidade</span> Curitiba - PR, Brasil</li-->
            </ul>
          </div>
          @if ( !empty($project->description_short))
          <div class="description jumbotron">
    		{!! nl2br(e($project->description_short)) !!}
          </div>
          @endif

          @if ( !empty($project->description))
          <div class="description">
    		{!! nl2br(e($project->description)) !!}
    		<br/>
    		<br/>
          </div>
          @endif

          <!-- PROJECT PANELS -->
		  @if ( $project->tasks->count() || $project->ismember(auth()->user()) || access()->hasrole('Administrator') )
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title"><i class="fa fa-question-circle"></i>&nbsp;Precisamos de ajuda para</h3>
            </div>
            <div class="panel-body">
			    @if ( $project->tasks->count() )
			        <ul>
			            @foreach( $project->tasks as $task )
			                <li>
		                        <a href="{{ route('projects.tasks.show', [$project->slug, $task->slug]) }}">
		                        	{{ $task->name }}
		                        	@if ($task->completed)
		                        	&nbsp;(Executada)
		                        	@endif
		                        </a>
			 				</li>
			            @endforeach
			        </ul>
			    @endif
			    @if ($project->ismember(auth()->user()) || access()->hasrole('Administrator'))
				    <p>
				      {!! link_to_route('projects.tasks.create', 'Nova tarefa', $project->slug, array('class' => 'btn btn-info btn-xs')) !!}
				    </p>
			    @endif
 
            </div>
          </div>
          @endif

		  @if ( !empty($project->url_1) || !empty($project->url_2) || !empty($project->url_3) )
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title"><i class="fa fa-link"></i>&nbsp;Links do projeto</h3>
            </div>
            <div class="panel-body">
            	@if (!empty($project->url_1))
            		{!! HTML::link($project->url_1) !!}<br/>
            	@endif
 
            	@if (!empty($project->url_2))
            		{!! HTML::link($project->url_2) !!}<br/>
            	@endif

            	@if (!empty($project->url_3))
            		{!! HTML::link($project->url_3) !!}<br/>
            	@endif
            </div>
          </div>
          @endif          
          <!-- /PROJECT PANELS -->

          <!-- PEOPLE -->
          <!--div class="people">
            <span><strong>16</strong> CONTRIBUIDORES</span>
            <ul class="list-unstyled list-inline">
              <li class="contrib-person"><a href="#"><img src="https://secure.gravatar.com/avatar/61bde54bc933a749f0b706b0dbb31c8c?d=https%3A%2F%2Fwalter.trakt.us%2Fplaceholders%2Fmedium%2Ffry.png&r=pg&s=256"/></a></li>
              <li class="contrib-person"><a href="#"><img src="https://secure.gravatar.com/avatar/61bde54bc933a749f0b706b0dbb31c8c?d=https%3A%2F%2Fwalter.trakt.us%2Fplaceholders%2Fmedium%2Ffry.png&r=pg&s=256"/></a></li>
              <li class="contrib-person"><a href="#"><img src="https://secure.gravatar.com/avatar/61bde54bc933a749f0b706b0dbb31c8c?d=https%3A%2F%2Fwalter.trakt.us%2Fplaceholders%2Fmedium%2Ffry.png&r=pg&s=256"/></a></li>
              <li class="contrib-person"><a href="#"><img src="https://secure.gravatar.com/avatar/61bde54bc933a749f0b706b0dbb31c8c?d=https%3A%2F%2Fwalter.trakt.us%2Fplaceholders%2Fmedium%2Ffry.png&r=pg&s=256"/></a></li>
            </ul>
          </div-->
          <!-- /PEOPLE -->

          <!-- TEAM -->
          <div class="team">
            <h3>
            	Time
            	@if ( !$project->ismember(auth()->user(),'member') )
	            	@if ( !$project->ismember(auth()->user(),'owner') )
						{!! link_to_route('projects.join', 'Participar', array($project->slug), 
						array('class' => 'btn btn-info btn-xs')) !!}
					@endif
			    @else
					{!! link_to_route('projects.leave', 'Sair', array($project->slug), 
					array('class' => 'btn btn-warning btn-xs')) !!}
			    @endif
            </h3>
            <ul class="list-unstyled list-inline">
	          @foreach( $project->members as $user )
	            <li class="team-person">
	            	<img src="/assets/img/avatar.png"/>{{ $user->name }}
	            </li>
	          @endforeach
            </ul>
          </div>
          <!-- /TEAM -->

		  <hr />

          <!-- COMMENT -->
          <div class="comments">

			@include('frontend/includes/comments')

          </div>
          <!-- /COMMENT -->

        </div>

      </div>

      <!-- OTHER PROJECTS -->
      <!--div class="other-projects">
        <h3>Conheça outros projetos</h3>
        <ul class="list-unstyled list-inline">
          <li class="related-project">
            <a href="#"><img src="https://walter.trakt.us/images/movies/000/000/009/fanarts/thumb/96364d5e6d.jpg"/>
              <span class="other-projects-title">Vizin</span>
            </a>
            <span class="loves"><i class="fa fa-heart"></i> <strong>60%</strong></span>
          </li>
          <li class="related-project">
            <a href="#"><img src="https://walter.trakt.us/images/movies/000/000/009/fanarts/thumb/96364d5e6d.jpg"/>
              <span class="other-projects-title">Vizin</span>
            </a>
            <span class="loves"><i class="fa fa-heart"></i> <strong>60%</strong></span>
          </li>
        </ul>
      </div-->
      <!-- /OTHER PROJECTS -->

      <!-- SEARCH PROJECTS -->
      <!--div class="search-projects">
        <h3>Encontre um projeto</h3>
        <input type="text" class="form-control" placeholder="Busque por Vizin, Kartão ou outros..."/>
      </div-->
      <!-- /OTHER PROJECTS -->
    </section>
    <!-- /PROJECT DESCRIPTION -->


@endsection

