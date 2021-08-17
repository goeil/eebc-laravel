@extends('articles.layout')

@section('content')
@parent
    <div class="container">
        <h1>{{ $etiquette->nom }}</h1>
        <div class="card-group">
        @foreach ($objects as $o)
            <div class="card col-md-6 col-lg-4">
            <x-object-card objectId="{{ $o->id }}" objectClass="{{ $o::class }}"/>
            </div>
        @endforeach
        </div>
    </div>
@endsection

