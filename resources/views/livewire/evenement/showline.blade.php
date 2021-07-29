<div class="card my-2">
  <div class="card-body">
      @if ($evenement->getMedia('illustration')->first())
          <img class="border rounded float-start me-2" src="{{ $evenement->getMedia('illustration')->first()->getUrl('thumb') }}" width="50">
      @endif
      @auth
      <div class="float-end ms-2">
        <a href="{{ route('evenements.edit', $evenement) }}" class="btn btn-primary"><i class="bi-pencil"></i></a>
      </div>
      @endauth
      <h5 class="card-title"><a href="{{ route('object', ['slug' => $evenement->slug]) }}">{{ $evenement->titre }}</a>
        <span class="badge bg-secondary ms-3">
          {{ Date::parse($evenement->horaire)->format('d F Y à H:i') }}
        </span>
      </h5>
      <p class="card-text">
        <strong>{{ $evenement->type->nom }}</strong>
        {{ $evenement->lieu->nom }}, <small>organisé par {{ $evenement->organisateur->nom }}</small>
      </p>
  </div>
</div>
