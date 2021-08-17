<div>
    <div class="card-header text-center">
    {{ Date::parse($article->debutpublication)->format('d F Y') }}
    </div>
    <div class="mt-1 mt-xl-0 card-body">
    <h4>
        <a class="" href="{{ route('object', ['slug' => $article->slug]) }}">
        {{ $article['titre'] }}
        </a>
    </h4>
        <p class="ts-1 small">
    <p>{{ $article->accroche() }}</p>
    </div>
    @if ($article->getMedia('illustration')->first())
    <img src="{{ $article->getMedia('illustration')->first()->getUrl('thumb') }}" class="m-0">
    @endif

</div>
