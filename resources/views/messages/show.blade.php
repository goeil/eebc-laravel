@extends('messages.layout')

@section('title', $message->titre)
@section('content')
@parent

    <div class="container-fluid">


      <div class="hero hero-article" class="d-flex align-items-center container-fluid"
      style="background: url('{{ $message->diapo() }}') center">
        <div class="container text-center position-relative" data-aos="fade-in" data-aos-delay="100" data-aos-duration="500">
          <h1>{{ $message->titre }}</h1>
          <h3>{{ $message->auteur->prenomNom() }} |
          {{ Date::parse($message->date)->format('d F Y') }}</h3>
        </div>
      </div><!-- End Hero -->

          @auth
          <!-- Boutons admin -->
          <div class="w-100 text-center my-2">
          <div class="btn-group" role="group" aria-label="Basic example">
            <a href="{{ route('messages.index') }}" 
               class="btn btn-secondary btn-sm me-1">
                  <i class="bi bi-card-list"></i> Liste admin
            </a>
            <a href="{{ route('messages.edit', $message) }}" class="btn
                           btn-primary btn-sm"><i class="bi-pencil"></i>Éditer</a>
          </div>
          </div>
          @endauth

  </div>
  <div class="container">

      <div class="row mt-3">
        <div class="col-md-8">
          @if ($message->lien)
            <x-embed url="{{ $message->lien }}" />
          @endif
          @if ($message->descriptionHtml)
            <div class="p-3">{!! $message->descriptionHtml !!}</div>
          @endif

          @if ($message->getMedia('attachments')->first())
            @if ($message->getMedia('attachments')->first()->mime_type == "image/jpeg")
            <h5 class="mt-3">Affiche</h5>
            <img class="w-100"
               src="{{ $message->getMedia('attachments')->first()->getUrl() }}">
            @else
            <h5 class="mt-3">À télécharger</h5>
            <a class="btn btn-secondary"
               href="{{ $message->getMedia('attachments')->first()->getUrl() }}">
               {{ $message->getMedia('attachments')->first()->name }}
               <small>({{ $message->getMedia('attachments')->first()->mime_type }})</small>
            </a>
            @endif
          @endif


        </div>
        <!-- Carte détails side -->
        <div class="col-md-4">
          <div class="card">
            <div class="card-body">
              <p class="card-text">
                <ul class="list-group">
                  <li class="list-group-item">Message donné le 
                      {{ Date::parse($message->date)->format('d F Y') }}</li>
                  <li class="list-group-item">Délivré par {{ $message->auteur->prenomNom() }}
                  </li>

                    @if ($message->livrebiblique)
                    <li class="list-group-item">Texte biblique : <span class="fw-bold">
                        {{ $message->livrebiblique->nom }} 
                        {{ $message->reference }}</span></li>
                    @endif

                  @if ($message->etiquettes()->count())
                  <li class="list-group-item">
                    @foreach($message->etiquettes()->get() as $t)
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
