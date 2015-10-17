@extends('frontend.layouts.master')

@section('content')

    <h2>{{ $project->name }}</h2>

    <p>{{ $project->description }}</p>

    <img src="{{ $project->profile }}"/>

@endsection
