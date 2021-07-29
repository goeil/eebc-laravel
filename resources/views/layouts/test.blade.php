<!DOCTYPE html>
<html>
    <head>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" >
       <title>
            Page de test pour composants
       </title>
       @livewireStyles
    </head>
    <body>

        @yield('navbar')

        <div class="container mt-2 p-3">
             {{ $slot }}
        </div>

       @livewireScripts
       <script src="{{ asset('js/app.js') }}" ></script>
       @yield('scripts')
    </body>
</html>




