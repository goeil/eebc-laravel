@extends('messages.layout')

@section('title', $message->titre)
@section('content')
@parent
    <div class="container">
        @if ($message->getMedia('illustration')->first())
        <div class="">
          <img src="{{ $message->getMedia('illustration')->first()->getUrl('diapo') }}"
               class="my-4">
        </div>
        @endif
        <h1>{{ $message->titre }}</h1>
        @if ($message->etiquettes()->count())
        <p class="ms-4">Mots-clés :
          @foreach($message->etiquettes()->get() as $t)
            <a class="btn badge rounded-pill bg-primary text-white" 
               href="{{ route('etiquette', $t->nomUrl()) }}">{{ $t->nom }}</a>
          @endforeach
        </p>
        @endif



          @auth
          <div class="btn-group" role="group" aria-label="Basic example">
            <a href="{{ route('messages.index') }}" 
               class="btn btn-secondary btn-sm me-1">
                  <i class="bi bi-card-list"></i> Liste admin
            </a>
            <a href="{{ route('messages.edit', $message) }}" class="btn
                           btn-primary btn-sm"><i class="bi-pencil"></i>Éditer</a>
          </div>
          @endauth

        <p><small>Donné par : {{ $message->auteur->prenomNom() }}</small></p>
        @if ($message->livrebiblique)
        <p>Texte biblique : <span class="fw-bold">
             {{ $message->livrebiblique->nom }} 
             {{ $message->reference }}</span></p>
        @endif
        <p>Publié le : {{ Date::parse($message->date)->format('d F Y') }}</p>



        @if ($message->lien)
            <x-embed url="{{ $message->lien }}" />
        @endif


        @if ($message->descriptionHtml)
          <div class="card p-3">{!! $message->descriptionHtml !!}</div>
        @endif

    </div>
@endsection
