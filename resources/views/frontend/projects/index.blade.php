@extends('frontend.layouts.master')

@section('content')

    <h2>Projetos</h2>
 
    @if ( !$projects->count() )
        Não tem projetos
    @else
        <ul>
            @foreach( $projects as $project )
                <li><a href="{{ route('projects.show', $project->slug) }}">{{ $project->name }}</a></li>
            @endforeach
        </ul>
    @endif

@endsection
