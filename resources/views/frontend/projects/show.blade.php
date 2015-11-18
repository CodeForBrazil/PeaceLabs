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
            {!! Form::open(array('class' => 'form-inline', 'method' => 'DELETE', 'route' => array('projects.destroy', $project->slug))) !!}
	            <h1>
	            	{{ $project->name }}
					{!! link_to_route('projects.edit', 'Editar', array($project->slug), array('class' => 'btn btn-info btn-xs')) !!}&nbsp;
					{!! Form::submit('Deletar', array('class' => 'btn btn-danger btn-xs')) !!}
	            </h1>
			{!! Form::close() !!}

          </div>
        </div>
      </div>
      <!-- /LOGO AND TITLE -->

      <!-- KPIS -->
      <div class="row loves">
        <div class="container">
          <div class="col-xs-12">
            <span class="kpi"><i class="fa fa-heart"></i> <strong>64</strong> loves</span>
          </div>
        </div>
      </div>
      <div class="row kpis">
        <div class="container">
          <div class="col-xs-12">
            <span class="kpi"><strong>2564</strong> views</span>
            <span class="kpi"><strong>123</strong> cheers</span>
            <span class="kpi"><strong>87</strong> followers</span>
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
          <ul class="list-group">
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
          </ul>
        </div>
        <div class="content-project col-sm-9">
          <div class="project-details">
            <ul class="list-inline">
              <li><span class="project-details-label">Data da Criação</span> 17/07/2013</li>
              <li><span class="project-details-label">Categoria</span> Social</li>
              <li><span class="project-details-label">Localidade</span> Curitiba - PR, Brasil</li>
              <li><span class="project-details-label">Data de Execução</span> 30/03/2014</li>
            </ul>
          </div>
          <div class="description">
            <p>{{ $project->description }}</p>
          </div>

          <!-- PROJECT PANELS -->
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">Precisamos de ajuda para</h3>
            </div>
            <div class="panel-body">
			    @if ( !$project->tasks->count() )
			        Não tem tarefa
			    @else
			        <ul>
			            @foreach( $project->tasks as $task )
			                <li>
		                        <a href="{{ route('projects.tasks.show', [$project->slug, $task->slug]) }}">{{ $task->name }}</a>
			 				</li>
			            @endforeach
			        </ul>
			    @endif
			    <p>
			           {!! link_to_route('projects.tasks.create', 'Nova tarefa', $project->slug) !!}
			    </p>
 
            </div>
          </div>
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">Fazer...</h3>
            </div>
            <div class="panel-body">
              Panel content
            </div>
          </div>
          <!-- /PROJECT PANELS -->

          <!-- PEOPLE -->
          <div class="people">
            <span><strong>16</strong> CONTRIBUIDORES</span>
            <ul class="list-unstyled list-inline">
              <li class="contrib-person"><a href="#"><img src="https://secure.gravatar.com/avatar/61bde54bc933a749f0b706b0dbb31c8c?d=https%3A%2F%2Fwalter.trakt.us%2Fplaceholders%2Fmedium%2Ffry.png&r=pg&s=256"/></a></li>
              <li class="contrib-person"><a href="#"><img src="https://secure.gravatar.com/avatar/61bde54bc933a749f0b706b0dbb31c8c?d=https%3A%2F%2Fwalter.trakt.us%2Fplaceholders%2Fmedium%2Ffry.png&r=pg&s=256"/></a></li>
              <li class="contrib-person"><a href="#"><img src="https://secure.gravatar.com/avatar/61bde54bc933a749f0b706b0dbb31c8c?d=https%3A%2F%2Fwalter.trakt.us%2Fplaceholders%2Fmedium%2Ffry.png&r=pg&s=256"/></a></li>
              <li class="contrib-person"><a href="#"><img src="https://secure.gravatar.com/avatar/61bde54bc933a749f0b706b0dbb31c8c?d=https%3A%2F%2Fwalter.trakt.us%2Fplaceholders%2Fmedium%2Ffry.png&r=pg&s=256"/></a></li>
            </ul>
          </div>
          <!-- /PEOPLE -->

          <!-- TEAM -->
          <div class="team">
            <h3>Time</h3>
            <ul class="list-unstyled list-inline">
              <li class="team-person"><img src="https://trakt.tv/assets/placeholders/thumb/poster-2d5709c1b640929ca1ab60137044b152.png"/><a href="#">Stephan Garcia</a></li>
              <li class="team-person"><img src="https://trakt.tv/assets/placeholders/thumb/poster-2d5709c1b640929ca1ab60137044b152.png"/><a href="#">Stephan Garcia</a></li>
              <li class="team-person"><img src="https://trakt.tv/assets/placeholders/thumb/poster-2d5709c1b640929ca1ab60137044b152.png"/><a href="#">Stephan Garcia</a></li>
              <li class="team-person"><img src="https://trakt.tv/assets/placeholders/thumb/poster-2d5709c1b640929ca1ab60137044b152.png"/><a href="#">Stephan Garcia</a></li>
              <li class="team-person"><img src="https://trakt.tv/assets/placeholders/thumb/poster-2d5709c1b640929ca1ab60137044b152.png"/><a href="#">Stephan Garcia</a></li>
            </ul>
          </div>
          <!-- /TEAM -->

          <!-- COMMENT -->
          <div class="comments">

			@include('frontend/includes/comments')

          </div>
          <!-- /COMMENT -->

        </div>

      </div>

      <!-- OTHER PROJECTS -->
      <div class="other-projects">
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
      </div>
      <!-- /OTHER PROJECTS -->

      <!-- SEARCH PROJECTS -->
      <div class="search-projects">
        <h3>Encontre um projeto</h3>
        <input type="text" class="form-control" placeholder="Busque por Vizin, Kartão ou outros..."/>
      </div>
      <!-- /OTHER PROJECTS -->
    </section>
    <!-- /PROJECT DESCRIPTION -->


@endsection

