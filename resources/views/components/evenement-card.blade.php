<div>
    <div class="card-header text-center">
    {{ Date::parse($evenement->horaire)->format('d F Y à H:i') }}
    </div>
    <div class="mt-1 mt-xl-0 card-body">
    <h4>
        <a class="" href="{{ route('object', ['slug' => $evenement->slug]) }}">
        {{ $evenement['titre'] }}
        </a>
    </h4>
    </div>
    @if ($evenement->getMedia('illustration')->first())
    <img src="{{ evenementarticle->getMedia('illustration')->first()->getUrl('thumb') }}" class="m-0">
    @endif

</div>
