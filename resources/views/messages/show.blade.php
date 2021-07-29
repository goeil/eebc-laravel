@extends('messages.layout')

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

              @auth
        <a href="{{ route('messages.index') }}" class="btn btn-secondary btn-small mb-3"><i class="bi bi-card-list"></i> Tous les messages</a>
                <a href="{{ route('messages.edit', $message) }}" class="btn
                           btn-primary"><i class="bi-pencil"></i></a>
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
