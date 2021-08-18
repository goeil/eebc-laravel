<div class="container-fluid">
          <div class="row gx-2">
            <div class="col-12">

@php
        $etiquette = App\Models\Etiquette::where('nom', 'top')->first();
        $objects = array();
        $messages = $etiquette->messages()->get();
        foreach($messages as $m)
        {
            $objects[] = $m;
        }
        $articles = $etiquette->articles()->get();
        foreach($articles as $m)
        {
            $objects[] = $m;
        }
        $evenements = $etiquette->evenements()->get();
        foreach($evenements as $m)
        {
            $objects[] = $m;
        }
@endphp

<!-- Slider main container -->
<div class="swiper-container my-3">
  <!-- Additional required wrapper -->
  <div class="swiper-wrapper">
    <!-- Slides -->
    @foreach($objects as $object)
    <div class="swiper-slide h-auto">
      <div class="card p-1 h-100">
        <a class="" href="{{ route('object', ['slug' => $object->slug]) }}">
        <div class="d-flex flex-row g-3 justify-content-start align-items-center">
          <div class="">
              <img class="img-thumbnail"
                src="{{ $object->diapo('diapo') }}" />
          </div>
          <div class="p-2 px-4 flex-grow-1">
            @if ($object instanceof App\Models\Evenement)
            <p class="">{{ Date::parse($object->horaire)->format('d F') }}</p>
            @elseif ($object instanceof App\Models\Article)
            <p class="">Réflexion</p>
            @endif
            <h5 class="card-title">{{ $object->titre }}</h5>
          </div>
        </div>
        </a>
      </div>
    </div>
    @endforeach

  </div>
  <!-- If we need pagination -->
  <div class="swiper-pagination"></div>

  <!-- If we need navigation buttons -->
  <div class="swiper-button-prev"></div>
  <div class="swiper-button-next"></div>

  <!-- If we need scrollbar -->
  <!--<div class="swiper-scrollbar"></div>-->
</div>
            </div>
          </div>
        </div>

@section('scripts')
@parent
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script>


const swiper = new Swiper('.swiper-container', {
  // Optional parameters
  slidesPerView: 1,
  spaceBetween: 40,
  breakpoints: {
    640: {
      slidesPerView: 8,
    },
    768: {
      slidesPerView: 3,
    },
    1024: {
      slidesPerView: 4,
    },
    1440: {
      slidesPerView: 5,
      spaceBetween: 50,
    },
  },

  direction: 'horizontal',
  loop: true,

  // If we need pagination
  pagination: {
    el: '.swiper-pagination',
    clickable: true,
  },

  // Navigation arrows
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },

  // And if we need scrollbar
  scrollbar: {
    //el: '.swiper-scrollbar',
  },
  autoplay: {
    delay: 3000,
    disableOnInteraction: false,
  },
  effect: 'coverflow',
  grabCursor: true,
  centeredSlides: true, //?
  coverflowEffect: {
      rotate: 33,
      stretch: 0,
      depth: 70,
      modifier: 1,
      slideShadows: false,
  },
});


</script>
@endsection
@section('styles')
@parent
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
@endsection
