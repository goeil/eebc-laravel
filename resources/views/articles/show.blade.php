@extends('articles.layout')

@section('title', $article->titre)
@section('content')
@parent

    <div class="container-fluid">

      <div class="hero hero-article" class="d-flex align-items-center container-fluid"
      style="background: url('{{ $article->diapo() }}') center">
        <div class="container text-center position-relative" data-aos="fade-in" data-aos-delay="100" data-aos-duration="500">
          <h1>{{ $article->titre }}</h1>
          @if ($article->soustitre)
          <h2>{{ $article->soustitre }}</h2>
          @endif
          <h3>{{ $article->auteur->prenomNom() }} |
          {{ Date::parse($article->debutpublication)->format('d F Y') }}</h3>
        </div>
      </div><!-- End Hero -->
    </div>

          @auth
          <!-- Boutons admin -->
          <div class="w-100 text-center my-2">
          <div class="btn-group" role="group" aria-label="Basic example">
            <a href="{{ route('articles.index') }}" 
               class="btn btn-secondary btn-sm me-1">
                  <i class="bi bi-card-list"></i> Liste admin
            </a>
            <a href="{{ route('articles.edit', $article) }}" class="btn
                           btn-primary btn-sm"><i class="bi-pencil"></i>Éditer</a>
          </div>
          </div>
          @endauth

  </div>
  <div class="container">

      <div class="row mt-3">
        <div class="col-md-8">
          @if ($article->articleHtml)
            <div class="p-3">{!! $article->articleHtml !!}</div>
          @endif

          @if ($article->getMedia('attachments')->first())
            @if ($article->getMedia('attachments')->first()->mime_type == "image/jpeg")
            <h5 class="mt-3">Affiche</h5>
            <img class="w-100"
               src="{{ $article->getMedia('attachments')->first()->getUrl() }}">
            @else
            <h5 class="mt-3">À télécharger</h5>
            <a class="btn btn-secondary"
               href="{{ $article->getMedia('attachments')->first()->getUrl() }}">
               {{ $article->getMedia('attachments')->first()->name }}
               <small>({{ $article->getMedia('attachments')->first()->mime_type }})</small>
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
                  @if ($article->etiquettes()->count())
                  <li class="list-group-item">
                    @foreach($article->etiquettes()->get() as $t)
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

