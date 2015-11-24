<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>Open Brazil</title>
    <meta name="generator" content="Bootply" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <link rel="stylesheet/less" type="text/css" href="/assets/less/style.less" />
    <script src="/assets/js/less.js" type="text/javascript"></script>

    <!--link href="/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.min.css" rel="stylesheet"-->
    <!--[if lt IE 9]>
      <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

  </head>
  <body>
	
@include('frontend.includes.nav')

@if (Session::has('message'))
	<div class="flash alert-info">
		<p>{{ Session::get('message') }}</p>
	</div>
@endif

<div class="header alt vert">
  <div class="container">

    <div class="intro">
	    <h1>OPEN BRAZIL: Hackathon Curitiba</h1>
	    <p class="lead">Bem vindo a plataforma de co criação de projetos Open Brazil!</p>
      <p class="lead">Tem uma ideia com foco em tecnologia e inovação cívica para melhorar a qualidade de vida em todo o Brasil? <br> Crie seu projeto abaixo! </p>
	</div>
	<div class="action">
      <a href="{{ route('projects.create') }}" class="btn btn-default btn-lg">Criar um projeto</a>
    </div>
  </div>
</div>

<div id="projetos" class="blurb">
  <div class="container">
    <div class="row">

    @if ( !$projects->count() )
        Ainda não tem projetos
    @else
		<ul class="teasers">
            @foreach( $projects as $project )
		        <li class="col-sm-4">
		          <article class="teaser">
		          	@role('Administrator')
				      {!! Form::open(array('class' => 'form-inline menu', 'method' => 'DELETE', 'route' => array('projects.destroy', $project->slug))) !!}
						{!! link_to_route('projects.edit', 'Editar', array($project->slug), array('class' => 'btn btn-info btn-xs')) !!}&nbsp;
						{!! Form::submit('Deletar', array('class' => 'btn btn-danger btn-xs')) !!}
					  {!! Form::close() !!}
			        @endauth
			        @if ( $project->ismember(auth()->user(),'owner'))
			          <div class="menu">
						{!! link_to_route('projects.edit', 'Editar', array($project->slug), array('class' => 'btn btn-info btn-xs')) !!}
					  </div>
			        @endif
		            <header>
		              <a href="{{ route('projects.show', $project->slug) }}"><img class="capa" src="{{ $project->cover_url(['height' => 160,'width' => 720, 'crop' => 'fill' ]) }}"/></a>
		              <a href="{{ route('projects.show', $project->slug) }}"><img src="{{ $project->profile_url(['height' => 50,'width' => 50, 'crop' => 'fill']) }}" class="profile img-responsive"/></a>
		              <h2>
		              	<a href="{{ route('projects.show', $project->slug) }}">{{ $project->name }}</a>
		              </h2>
		            </header>
		            <div class="teaser-body">
		              <p>
		                {{ $project->description }}
		              </p>
		            </div>
		            <div class="row">
			            <footer class="col-xs-6 col-sm-12 col-md-6">
			              <div class="row loves">
					            <span class="kpi" title="Likes"><i class="fa fa-heart"></i> <strong>{{ $project->likes->count() }}</strong></span>&nbsp;
					            <span class="kpi" title="Views"><i class="fa fa-eye"></i> <strong>{{ $project->viewsCount() }}</strong></span>&nbsp;
					            <span class="kpi" title="Participantes"><i class="fa fa-users"></i> <strong>{{ $project->members->count() }}</strong></span>
					      </div>
			            </footer>
			            <footer  class="col-xs-6 col-sm-12 col-md-6" style="text-align: right;">
	
			              <a href="{{ route('projects.show', $project->slug) }}">Saber mais...</a>
			            </footer>
		            </div>
		          </article>
		        </li>
            @endforeach
        </ul>
    @endif 

    </div>
  </div>
</div>

<div class="" id="services">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
					<hr class="primary">
                    <h2 class="section-heading">PeaceLabs é uma plataforma colaborativa de projetos que foi co criada por hackers civicos do CodeForCuritiba. <br> Aqui você pode compartilhar suas ideias e habilidades para fazer de suas ideias um projeto bem sucedido!</h2>
					<br /><br />
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
				<div class="col-lg-4 col-md-6">
                    <div class="service-box text-center">
                        <i class="fa fa-4x fa-lightbulb-o wow bounceIn text-primary" data-wow-delay=".2s"></i>
                        <h3>Ideias</h3>
                    </div>  
					<ul>				
						<li class="text-muted">Tem alguma ideia de projeto que esta querendo tirar do papel?</li>
						<li class="text-muted">Qual solução social, ambiental ou econômica você tem?</li>
						<li class="text-muted">Qual o problema que você acha que a humanidade deve resolver hoje?</li>
                    </ul>
                </div>
                <div class="col-lg-4 col-md-6 ">
                    <div class="service-box text-center">
                        <i class="fa fa-4x fa fa-cogs wow bounceIn text-primary" data-wow-delay=".3s"></i>
                        <h3>Habilidades</h3>
					</div>
					<ul>
						<li class="text-muted">Você é um designer, programador ou gerente de projetos? Ou talvez um escritor, comerciante ou networker?</li>
						<li class="text-muted">Você sabe como fazer algo melhor do que outras pessoas?</li>
						<li class="text-muted">O que você adora fazer e sabe que pode ter valor a outras pessoas?</li>
					</ul>
					
                </div>
            </div>
        </div>
    
</div>


<footer>
  <div class="container">
    <div class="row">
      <div class="col-md-6 col-md-offset-3 text-center">
        <ul class="list-inline">
          <li><i class="icon-facebook icon-2x"></i></li>
          <li><i class="icon-twitter icon-2x"></i></li>
          <li><i class="icon-google-plus icon-2x"></i></li>
        </ul>
        <hr>
      Code For Brazil - PeaceLabs ©2015</p>
      </div>
    </div>
  </div>
</footer>

<ul class="nav pull-right scroll-down">
  <li><a href="#" title="Scroll down"><i class="icon-chevron-down icon-3x"></i></a></li>
</ul>
<ul class="nav pull-right scroll-top">
  <li><a href="#" title="Scroll to top"><i class="icon-chevron-up icon-3x"></i></a></li>
</ul>

  <!-- script references -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
    <script src="/assets/js/bootstrap.min.js"></script>
    <script src="/assets/js/scripts.js"></script>
  </body>
</html>