<div>
    <div class="card-header text-center">
    {{ Date::parse($message->date)->format('d F Y') }}
    </div>
    <div class="mt-1 mt-xl-0 card-body">
    {{--<i class="bi bi-file-play"></i>--}}
    <h4>
        <a class="" href="{{ route('object', ['slug' => $message->slug]) }}">
        {{ $message['titre'] }}
        </a>
    </h4>
        <p class="ts-1 small">
        @if ($message->livrebiblique)
            {{ $message->livrebiblique->abreviation }} {{ $message->reference }}
        @endif
        | {{ $message->auteur->abrege() }}
        </p>
    <p>{{ $message->accroche() }}</p>
    </div>
    @if ($message->lien)
    <div class="m-1">
    <x-embed url="{{ $message->lien }}" />
    </div>
    @elseif ($message->getMedia('illustration')->first())
    <img src="{{ $message->getMedia('illustration')->first()->getUrl('thumb') }}" class="m-0">
    @endif

</div>
