@extends('evenements.layout')

@section('title', $evenement->titre)
@section('content')
@parent
    <div class="container">
      <div class="w-100 text-left">
          <a href="{{ route('agenda') }}" class="btn btn-secondary btn m-3 text-center">
              <i class="bi bi-calendar-month"></i> Retourner à l'agenda
          </a>
      </div>

      <div class="hero hero-article" class="d-flex align-items-center container-fluid"
      style="background: url('{{ $evenement->diapo() }}') center">
        <div class="container text-center position-relative" data-aos="fade-in" data-aos-delay="100" data-aos-duration="500">
          <h1>{{ $evenement->titre }}</h1>
          <h2>{{ Date::parse($evenement->horaire)->format('d F Y à H:i') }}</h2>
        </div>
      </div><!-- End Hero -->

          @auth
          <div class="w-100 text-center my-2">
          <div class="btn-group" role="group" aria-label="Basic example">
            <a href="{{ route('evenements.index') }}" 
               class="btn btn-secondary btn-sm me-1">
                  <i class="bi bi-card-list"></i> Liste admin
            </a>
            <a href="{{ route('evenements.edit', $evenement) }}" class="btn
                           btn-primary btn-sm"><i class="bi-pencil"></i>Éditer</a>
          </div>
          </div>
          @endauth

      <div class="row mt-3">
        <div class="col-md-8">
          @if ($evenement->descriptionHtml)
            <div class="p-3">{!! $evenement->descriptionHtml !!}</div>
          @endif

          @if ($evenement->getMedia('attachments')->first())
            @if ($evenement->getMedia('attachments')->first()->mime_type == "image/jpeg")
            <h5 class="mt-3">Affiche</h5>
            <img class="w-100"
               src="{{ $evenement->getMedia('attachments')->first()->getUrl() }}">
            @else
            <h5 class="mt-3">À télécharger</h5>
            <a class="btn btn-secondary"
               href="{{ $evenement->getMedia('attachments')->first()->getUrl() }}">
               {{ $evenement->getMedia('attachments')->first()->name }}
               ({{ $evenement->getMedia('attachments')->first()->mime_type }})
            </a>
            @endif
          @endif
        </div>
        <div class="col-md-4">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">
                Détails
              </h5>
              <p class="card-text">
                <ul class="list-group">
                  <li class="list-group-item">Jour : 
                      {{ Date::parse($evenement->horaire)->format('d F Y') }}</li>
                  <li class="list-group-item">Horaire : 
                      {{ Date::parse($evenement->horaire)->format('H:i') }}</li>
                  <li class="list-group-item">{{ $evenement->type->nom }}</li>
                  <li class="list-group-item">{{ $evenement->lieu->nom }}
                    <p>{{ $evenement->lieu->adresse }}</p>
                  </li>
                  <li class="list-group-item">Organisé par 
                        <a href="https://{{ $evenement->organisateur->url }}">{{ $evenement->organisateur->nom }}</a></li>

                  @if ($evenement->etiquettes()->count())
                  <li class="list-group-item">
                    @foreach($evenement->etiquettes()->get() as $t)
                      <a class="btn badge rounded-pill bg-primary text-white" 
                         href="{{ route('etiquette', $t->nomUrl()) }}">{{ $t->nom }}</a>
                    @endforeach
                  @endif
                </ul>
              </p>
            </div>
          </div>
        </div>
      </div>

    </div>
@endsection
