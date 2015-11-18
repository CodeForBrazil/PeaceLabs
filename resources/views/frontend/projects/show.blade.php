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

<!-- begin wwww.htmlcommentbox.com -->
 <div id="HCB_comment_box"><a href="http://www.htmlcommentbox.com">Comment Form</a> is loading comments...</div>
 <link rel="stylesheet" type="text/css" href="//www.htmlcommentbox.com/static/skins/bootstrap/twitter-bootstrap.css?v=0" />
 <script type="text/javascript" id="hcb"> /*<!--*/ if(!window.hcb_user){hcb_user={};} (function(){var s=document.createElement("script"), l=hcb_user.PAGE || (""+window.location).replace(/'/g,"%27"), h="//www.htmlcommentbox.com";s.setAttribute("type","text/javascript");s.setAttribute("src", h+"/jread?page="+encodeURIComponent(l).replace("+","%2B")+"&mod=%241%24wq1rdBcg%24fnx5YwJNmfKHBhq0cW8fl."+"&opts=16862&num=10&ts=1447871473904");if (typeof s!="undefined") document.getElementsByTagName("head")[0].appendChild(s);})(); /*-->*/ </script>
<!-- end www.htmlcommentbox.com -->

<!-- customize labels of htmlcommentbox.com -->
<script>
// This code goes ABOVE the main HTML Comment Box code!
// replace the text in the single quotes below to customize labels.
hcb_user = {
    // L10N
    comments_header : 'Comentários',
    name_label : 'Nome',
    content_label: 'Entre seu comentário aqui',
    submit : 'Comentar',
    logout_link : '<img title="desconect" src="//www.htmlcommentbox.com/static/images/door_out.png" alt="[desconect]" class="hcb-icon"/>',
    admin_link : '<img src="//www.htmlcommentbox.com/static/images/door_in.png" alt="[login]" class="hcb-icon"/>',
    no_comments_msg: 'Ainda sem comentários. Seja o primeiro!',
    add:'Deixar um comentário',
    again: 'Deixar um outro comentário',
    rss:'<img src="//www.htmlcommentbox.com/static/images/feed.png" class="hcb-icon" alt="rss"/> ',
    said:'falou:',
    prev_page:'<img src="//www.htmlcommentbox.com/static/images/arrow_left.png" class="hcb-icon" title="previous page" alt="[prev]"/>',
    next_page:'<img src="//www.htmlcommentbox.com/static/images/arrow_right.png" class="hcb-icon" title="next page" alt="[next]"/>',
    showing:'Mostrando',
    to:'para',
    website_label:'website (opcional)',
    email_label:'email',
    anonymous:'Anónimo',
    mod_label:'(mod)',
    subscribe:'me mandar as respostas',
    are_you_sure:'Você quer notificar esse comentário como inapropriado?',
    
    reply:'<img src="//www.htmlcommentbox.com/static/images/reply.png"/> responder',
    flag:'<img src="//www.htmlcommentbox.com/static/images/flag.png"/> notificar',
    like:'<img src="//www.htmlcommentbox.com/static/images/like.png"/> curtir',
    
    //dates
    days_ago:'days ago',
    hours_ago:'hours ago',
    minutes_ago:'minutes ago',
    within_the_last_minute:'within the last minute',

    msg_thankyou:'Thank you for commenting!',
    msg_approval:'(this comment is not published until approved)',
    msg_approval_required:'Thank you for commenting! Your comment will appear once approved by a moderator.',
    
    err_bad_html:'Your comment contained bad html.',
    err_bad_email:'Please enter a valid email address.',
    err_too_frequent:'You must wait a few seconds between posting comments.',
    err_comment_empty:'Your comment was not posted because it was empty!',
    err_denied:'Your comment was not accepted.',

    //SETTINGS
    MAX_CHARS: 2048,
    PAGE:'', // ID of the webpage to show comments for. defaults to the webpage the user is currently visiting.
    RELATIVE_DATES:true // show dates in the form "X hours ago." etc.
};
</script>
<!-- done customizing labels of htmlcommentbox.com -->

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

