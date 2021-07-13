<!DOCTYPE html>
<html>
    <head>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" >
       <title>
            Page publique
       </title>
    </head>
    <body>

        @yield('navbar')

        <div class="container mt-2 p-3">
             @yield('content')
        </div>
    </body>
</html>



