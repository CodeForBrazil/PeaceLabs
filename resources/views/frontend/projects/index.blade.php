@extends('frontend.layouts.master')

@section('content')

    <h2>Projects</h2>
 
    @if ( !$projects->count() )
        You have no projects
    @else
        <ul>
            @foreach( $projects as $project )
                <li><a href="{{ route('projects.show', $project->id) }}">{{ $project->name }}</a></li>
            @endforeach
        </ul>
    @endif

@endsection
