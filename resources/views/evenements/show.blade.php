@extends('evenements.layout')

@section('title', $evenement->titre)
@section('content')
@parent
    <div class="container">
        <h1>{{ $evenement->titre }}</h1>
        @if ($evenement->etiquettes()->count())
        <p class="ms-4">Mots-clés :
          @foreach($evenement->etiquettes()->get() as $t)
            <a class="btn badge rounded-pill bg-primary text-white" 
               href="{{ route('etiquette', $t->nomUrl()) }}">{{ $t->nom }}</a>
          @endforeach
        </p>
        @endif

          @auth
          <div class="btn-group" role="group" aria-label="Basic example">
            <a href="{{ route('agenda') }}" class="btn btn-secondary btn-sm me-1">
                 <i class="bi bi-calendar-month"></i> Vue calendrier
            </a>
            <a href="{{ route('evenements.index') }}" 
               class="btn btn-secondary btn-sm me-1">
                  <i class="bi bi-card-list"></i> Liste admin
            </a>
            <a href="{{ route('evenements.edit', $evenement) }}" class="btn
                           btn-primary btn-sm"><i class="bi-pencil"></i>Éditer</a>
          </div>
          @endauth

        @if ($evenement->getMedia('illustration')->first())
        <div>
          <img src="{{ $evenement->getMedia('illustration')->first()->getUrl('diapo') }}"
               class="my-4">
        </div>
        @endif

        <h3>{{ Date::parse($evenement->horaire)->format('d F Y à H:i') }}</h3>

        <p><strong>{{ $evenement->type->nom }}</strong></p>
        <p>Lieu : {{ $evenement->lieu->nom }}</p>

        @if ($evenement->etiquettes()->count())
        <p class="ms-4">Étiquettes : 
          @foreach($evenement->etiquettes()->get() as $t)
           {{ $t->nom }}
          @endforeach
        </p>
        @endif
        <p><small>Organisé par : <a href="https://{{ $evenement->organisateur->url }}" 
                 target="_blank"
                 title="{{ $evenement->organisateur->description }}"
                  >{{ $evenement->organisateur->nom }}</a></small></p>
        @if ($evenement->descriptionHtml)
          <div class="card p-3 w-75">{!! $evenement->descriptionHtml !!}</div>
        @endif

    </div>
@endsection
