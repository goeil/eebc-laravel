@extends('evenements.layout')

@section('content')
@parent
    <div class="container">
        <h1>{{ $evenement->titre }}</h1>

              @auth
        <a href="{{ route('evenements.index') }}" class="btn btn-secondary btn-small mb-3"><i class="bi bi-card-list"></i> Tous les évènements</a>
                <a href="{{ route('evenements.edit', $evenement) }}" class="btn
                           btn-primary"><i class="bi-pencil"></i></a>
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
        <p class="ms-4">Étiquettes : 
          @foreach($evenement->etiquettes()->get() as $t)
           {{ $t->nom }}
          @endforeach
        </p>
        <p><small>Organisé par : {{ $evenement->organisateur->nom }}</small></p>
        @if ($evenement->descriptionHtml)
          <div class="card p-3 w-75">{!! $evenement->descriptionHtml !!}</div>
        @endif

    </div>
@endsection
