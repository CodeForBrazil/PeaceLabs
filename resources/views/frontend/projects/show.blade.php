@extends('frontend.layouts.master')

@section('content')

    <!-- HEADER PROJECT PROFILE -->
    <section class="col-xs-12 cover" style="background-image: url('{{ $project->cover }}')">

      <!-- LOGO AND TITLE -->
      <div class="container">
        <img class="poster" src="{{ $project->profile }}" alt="{{ $project->name }} logo" />
      </div>
      <div class="row project-title">
        <div class="container">
          <div class="col-xs-12">
            <h1>{{ $project->name }}</h1>
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
        </div>
      </div>
    </section>
    <!-- /PROJECT DESCRIPTION -->

    <!-- PEOPLE -->

    <section class="row">
      <div class="container">
        <div class="people">
          <span><strong>16</strong> PEOPLE IN THIS PROJECT</span>
        </div>
      </div>
    </section>

    <!-- /PEOPLE -->

@endsection

