<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" >
    @yield('styles')
       <title>
            @yield('title')
       </title>
       @livewireStyles
       <x-embed-styles />







    </head>
    <body class="">











        <header id="header" class="fixed-top d-flex align-items-center">
            <x-navbar />
        </header><!-- End Header -->


        <main style="margin-top: 0px" 
            class="container-fluid p-0 pb-3 flex-grow-1 flex-column flex-sm-row">
            {{--@auth--}}
            @if (false)
                <div class="row flex-grow-sm-1 flex-grow-0">
                    <div class="col-sm-3 flex-grow-sm-1 flex-shrink-1 flex-grow-0 sticky-top pb-sm-0 pb-3">
                        <x-admin-bar />
                    </div>
                    <div class="col-sm-9 overflow-auto h-100">
                        <div class="p-3">
                            @yield('content')
                        </div>
                    </div>
                </div>
            @else
                <div class="container-fluid p-0">
                    @yield('content')
                </div>
            @endauth
        </main>

        <!-- Bouton back-to-top -->
        <a href="#" class="back-to-top d-flex align-items-center justify-content-center">
        <i class="bi bi-arrow-up-short fw-bold fs-1 text-primary"></i></a>


        <footer id="footer" class="">
            <x-footer />
        </footer><!-- End Header -->

       @livewireScripts
       <script src="{{ asset('js/app.js') }}" ></script>















       @yield('scripts')
    </body>
</html>




