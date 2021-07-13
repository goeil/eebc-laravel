@extends('public')
@section('content')
    <div>
        <h3>{{ $evenement->titre }}</h3>
        <img src="{{ $evenement->getMedia('illustration')->first()->getUrl('thumb') }}">
        <img src="{{ $evenement->getMedia('illustration')->first()->getUrl('square') }}">

    </div>

@endsection
