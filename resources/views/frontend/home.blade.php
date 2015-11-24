<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>PeaceLabs - Open Brazil</title>
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
	    <h1>HACKATHON CURITIBA 2015</h1>
	    <p class="lead">Plataforma colaborativa de projetos: Hackathon Curitiba 2015</p>
	    <p class="lead">Coloque sua ideia em prática! <br> Convide sua rede para colaborar no projeto dos seus sonhos.</p>
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
		              <img class="capa" src="{{ $project->cover_url(['height' => 160,'width' => 720, 'crop' => 'fill' ]) }}"/>
		              <img src="{{ $project->profile_url(['height' => 50,'width' => 50, 'crop' => 'fill']) }}" class="profile img-responsive"/>
		              <h2>
		              	<a href="{{ route('projects.show', $project->slug) }}">{{ $project->name }}</a>
		              </h2>
		            </header>
		            <div class="teaser-body">
		              <p>
		                {{ $project->description }}
		              </p>
		            </div>
		            <footer>
		              <a href="{{ route('projects.show', $project->slug) }}">Saber mais sobre este projeto</a>
		            </footer>
		          </article>
		        </li>
            @endforeach
        </ul>
    @endif 

    </div>
  </div>
</div>

<div class="" id="sec2 services">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Como funciona?</h2>
                    <hr class="primary">
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
						<li class="text-muted">O que é paz para você?</li>
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
				<div class="col-lg-4 col-md-6">
                    <div class="service-box text-center">
                        <i class="fa fa-4x fa-money wow bounceIn text-primary" data-wow-delay=".1s"></i>
                        <h3>Dinehiro</h3>
                    </div>
					<ul>			
						<li class="text-muted">Você é um entusiasta dos projetos sociais? Gosta de projetos crowdfunding online?</li>
						<li class="text-muted">Você prefere investir seu dinheiro em soluções que melhorar nosso mundo?</li>
						<li class="text-muted">Conhce alguem que quer investir seu dinheiro melhor?</li>
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