@extends('articles.layout')

@section('content')
@parent
    <div class="container">
        <h1>{{ $article->titre }}</h1>
        <h3>{{ $article->soustitre }}</h3>

              @auth
        <a href="{{ route('articles.index') }}" class="btn btn-secondary btn-small mb-3"><i class="bi bi-card-list"></i> Tous les articles</a>
                <a href="{{ route('articles.edit', $article) }}" class="btn
                           btn-primary"><i class="bi-pencil"></i></a>
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
