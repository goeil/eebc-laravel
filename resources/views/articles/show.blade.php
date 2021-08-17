@extends('articles.layout')

@section('title', $article->titre)
@section('content')
@parent
    <div class="container">
        <h1>{{ $article->titre }}</h1>
        <h3>{{ $article->soustitre }}</h3>
        @if ($article->etiquettes()->count())
        <p class="ms-4">Mots-clés :
          @foreach($article->etiquettes()->get() as $t)
            <a class="btn badge rounded-pill bg-primary text-white" 
               href="{{ route('etiquette', $t->nomUrl()) }}">{{ $t->nom }}</a>
          @endforeach
        </p>
        @endif

          @auth
          <div class="btn-group" role="group" aria-label="Basic example">
            <a href="{{ route('articles.index') }}" 
               class="btn btn-secondary btn-sm me-1">
                  <i class="bi bi-card-list"></i> Liste admin
            </a>
            <a href="{{ route('articles.edit', $article) }}" class="btn
                           btn-primary btn-sm"><i class="bi-pencil"></i>Éditer</a>
          </div>
          @endauth

        @if ($article->getMedia('illustration')->first())
        <div class="float-lg-end">
          <img src="{{ $article->getMedia('illustration')->first()->getUrl('diapo') }}"
               class="my-4">
        </div>
        @endif


        <p><small>Écrit par : {{ $article->auteur->prenomNom() }}</small></p>
        <p>Publié le : {{ Date::parse($article->debutpublication)->format('d F Y') }}</p>
        @if ($article->articleHtml)
          <div class="card p-3 w-75">{!! $article->articleHtml !!}</div>
        @endif

    </div>
@endsection
