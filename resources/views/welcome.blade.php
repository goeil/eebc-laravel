@extends('layouts.template')

@section('title', 'EEBC')

@section('content')
  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center container-fluid"
  style="background: url('{{ asset("images/hero-bg.jpg") }}') center center">
    <div class="container text-center position-relative" data-aos="fade-in" data-aos-delay="200" data-aos-duration="1500">
      <img src="{{ asset('images/EEBC_blanc.png') }}" 
         class="mb-5"
         width="380">
      <h2>Une communauté chrétienne dans le Jura bernois</h2>
      <a href="#about" class="btn-scroll scrollto" style="position:absolute"
        ><i class="bi bi-chevron-down fw-bold fs-1"></i></a>
    </div>
  </section><!-- End Hero -->

    <!-- ======= Clients Section ======= -->
    <section id="clients" class="clients mb-5">
      <div class="container-fluid">

        <div class="d-flex justify-content-around flex-fill w-100">

          <div class="" data-aos="zoom-in" data-aos-delay="100">
            <i class="bi bi-arrow-up-square-fill me-1"></i>Ce que nous croyons
          </div>
          <div class="" data-aos="zoom-in" data-aos-delay="100">
            <i class="bi bi-calendar2-fill me-1"></i>Agenda
          </div>
          <div class="" data-aos="zoom-in" data-aos-delay="100">
            <i class="bi bi-file-play-fill me-1"></i>Messages
          </div>

          {{--<div class="" data-aos="zoom-in" data-aos-delay="200">
            <img src="assets/img/clients/client-2.png" class="img-fluid" alt="">
          </div>--}}

        </div>

      </div>
    </section><!-- End Clients Section -->


    <!-- ======= About Section ======= -->
    <section id="about" class="about mt-5">
      <div class="container">

        <div class="row content">
          <div class="col-lg-6" data-aos="fade-right" data-aos-delay="100">
            <h2>Une communauté de chrétiens de tous horizons</h2>
            <h3>Implantée depuis 1902 à Court</h3>
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0" data-aos="fade-left" data-aos-delay="500">
            <p>L’Église évangélique baptiste de Court trouve sa mission dans le
               mandat de Dieu pour son Église.
Nous cherchons à appliquer localement cette mission dans notre contexte.</p>
            <p>Notre désir :</p>
            <ul>
              <li><i class="bi bi-check-all"></i>
                <strong>Annoncer la Parole de Dieu</strong>, de façon actuelle et
                 pertinente, pour la laisser transformer nos vies.
              </li>
              <li><i class="bi-check-all"></i>
                <strong>Construire et vivre des relations</strong> empreintes de
                 respect et d'amour entre nous, sans barrières de génération ni de culture.
              </li>
              <li><i class="bi-check-all"></i>
                <strong>Être témoins</strong>
                 de l’amour et du projet de salut de Dieu pour tous.
              </li>
            </ul>
            <a href="{{ asset('docs/vision_eebc.pdf') }}" data-aos="zoom-in" data-aos-delay="300"
              class="btn btn-outline-secondary btn-sm fw-bold">
              <i class="bi bi-file-pdf-fill fs-5"></i> Notre vision en 10 points</a>
          </div>
          <div class="text-center">
            <a href="#agenda" class="btn-scroll scrollto" style="position: absolute"
              ><i class="bi bi-chevron-down fw-bold fs-1 text-secondary"></i></a>
          </div>
        </div>

      </div>
    </section><!-- End About Section -->

    <!-- ======= Agenda Section ======= -->
    <section id="agenda" class="bg-secondary agenda mt-5 d-flex align-items-stretch">
      <div class="container-fluid">

        <div class="d-flex justify-content-around flex-fill w-100" data-aos="fade-right" data-aos-duration="800">

          <div class="p-0 mx-4 d-flex flex-column align-items-stretch">
            <i class="bi bi-calendar2-fill me-1 fs-1 text-white align-self-start"></i>
            <h3 class="d-flex flex-column align-items-start">
               <span class="fw-light ms-1 text-white">Prochains</span>
               <span class="fw-normal ms-1 text-white">évènements</span>
            </h3>
            <i class="bi bi-arrow-bar-right me-1 fs-1 text-white align-self-end"></i>
          </div>

          <div class="row">
            @php $timer = 300; @endphp
            @foreach ($evenements as $evenement)
              <div class="card p-0 m-4 shadow col-lg-2 col-sm-6"
                   data-aos="fade-left" data-aos-delay="{{ $timer }}"
                        >{{-- todo responsive : changer présentation sous forme de liste ? --}}
                <div class="card-header bg-dark text-white py-1" >
                  {{ $evenement->horaireHumain() }}
                </div>

                <div class="card-body" style="bg-white">
                  <div class="d-flex flex-row">
                  <div class="bg-warning me-2" style="height:2.5rem">&nbsp;</div>
                  <h5>{{ $evenement->titre }}</h5>
                  </div>
                  @if ($evenement->getMedia('illustration')->first())
                    <img src="{{ $evenement->getMedia('illustration')->first()->getUrl('thumb') }}"
                      class="ms-1 me-3">
                  @endif
                </div>
                <div class="card-footer" style="bg-light">
                  <a class="btn btn-secondary"
                   href="{{ route('object', ['slug' => $evenement->slug]) }}">
                   Détails
                  </a>
                </div>
              </div>
              @php $timer += 300; @endphp
            @endforeach
          </div>

        </div>
          <div class="text-center">
            <a href="#messages" class="btn-scroll scrollto" style="position: absolute"
              ><i class="bi bi-chevron-down fw-bold fs-1 text-white"></i></a>
          </div>

      </div>
    </section><!-- End Agenda Section -->


    <!-- ======= Messages et cultes ======= -->
    <section id="messages">
      <div class="container">

        <div class="row">
          <div class="col-lg-8 d-flex align-items-stretch">
            <div class="icon-boxes d-flex flex-column justify-content-center">
              <div class="row">
              @foreach ($messages as $message)
                <div class="card col-md-4 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
                  <div class="card-header text-center">
                    <p>{{ Date::parse($message->date)->format('d F Y') }}</p>
                  </div>
                  <div class="icon-box mt-2 mt-xl-0 card-body">
                    {{--<i class="bi bi-file-play"></i>--}}
                    <h4>
                      <a class="" href="{{ route('object', ['slug' => $message->slug]) }}">
                  </a>
                    </h4>
                      {{ $message['titre'] }}
                      <p class="ts-1">
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
              @endforeach
              </div>
            </div><!-- End .content-->
          </div>
          <div class="col-lg-4 d-flex align-items-stretch" data-aos="fade-right">
            <div class="content">
              <h3>Réécoutez quelques uns des derniers messages</h3>
              <p>
                En principe, nous enregistrons chaque prédication du dimanche. Vous
                pouvez les retrouver ici, ou sur notre chaine Youtube.
              </p>
              <div class="text-center">
                <a href="https://www.youtube.com/channel/UCfwiLNIv3YYwaqASUsh2VIg" class="more-btn"><i class="bi bi-youtube fs-3"></i> Chaine Youtube</a>
                <a href="{{ route('messages.index') }}" class="more-btn"><i class="bi bi-collection-play fs-3"></i> Tous les messages</a>
              </div>
            </div>
          </div>
          <div class="text-center">
            <a href="#contact" class="btn-scroll scrollto" style="position: absolute"
              ><i class="bi bi-chevron-down fw-bold fs-1 text-primary"></i></a>
          </div>
        </div>

      </div>
    </section><!-- End Why Us Section -->

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact bg-dark p-5 text-white">
      <div class="container">
        <div class="row content">
          <div class="col-lg-4" data-aos="fade-right">
            <div class="section-title">
              <h2>Contact</h2>
                <ul>
                  <li><i class="bi bi-check-all"></i>
                    <strong>Culte</strong> : chaque dimanche à 9 h 30
                  </li>
                  <li><i class="bi bi-check-all"></i>
                    <strong>Rencontre de semaine</strong> : chaque mercredi à 20 h
                  </li>
                </ul>
            </div>
          </div>

          <div class="col-lg-8" data-aos="fade-up" data-aos-delay="100">
{{--<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d18222.68313182331!2d7.320984526644545!3d47.23970472642542!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4791e06eaef96fc5%3A0xa97c226a7a3ebeff!2s%C3%89glise%20%C3%A9vang%C3%A9lique%20baptiste%20de%20Court!5e0!3m2!1sfr!2sch!4v1627406236660!5m2!1sfr!2sch" style="border:0; width: 100%; height: 270px;" allowfullscreen="true" loading="lazy"></iframe>--}}
            <div class="info mt-4">
              <i class="bi bi-geo-alt"></i>
              <h4>Adresse :</h4>
              <p>Rue du Temple 13, 2738 Court (Suisse, BE)</p>
            </div>
            <div class="row">
              <div class="col-lg-6 mt-4">
                <div class="info">
                  <i class="bi bi-envelope"></i>
                  <h4>Courriel :</h4>
                  <p>info@eebc.ch</p>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="info w-100 mt-4">
                  <i class="bi bi-phone"></i>
                  <h4>Téléphone :</h4>
                  <p>+41 32 497 90 76</p>
                </div>
              </div>
            </div>

            <form action="forms/contact.php" method="post" role="form" class="php-email-form mt-4">
              <div class="row">
                <div class="col-md-6 form-group">
                  <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
                </div>
                <div class="col-md-6 form-group mt-3 mt-md-0">
                  <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
                </div>
              </div>
              <div class="form-group mt-3">
                <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
              </div>
              <div class="form-group mt-3">
                <textarea class="form-control" name="message" rows="5" placeholder="Message" required></textarea>
              </div>
              <div class="my-3">
                <div class="loading">Loading</div>
                <div class="error-message"></div>
                <div class="sent-message">Your message has been sent. Thank you!</div>
              </div>
              <div class="text-center"><button type="submit">Send Message</button></div>
            </form>
          </div>
        </div>

      </div>
    </section><!-- End Contact Section -->

@endsection

