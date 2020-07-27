<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href={{asset('css/app.css')}} rel='stylesheet'>
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body>
        @section('navbar')
    <div class='container col-md-12 no-gutters'>
        <div class="col-md-12 no-gutters">
            <nav class="navbar navbar-dark bg-dark">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <a class='navbar-brand' href='/dashBoard'>DashBoard</a>
            </nav>
            <div class="collapse navbar-collapse" id="navbarToggleExternalContent">
                <div class="bg-dark p-4">
                    <li>
                        <a class='bg-dark text-white h5 nav-link' href='/dashBoard'>home </a>
                    </li>
                    <li>
                        <a class='bg-dark text-white h5 nav-link' href='/dashBoard'>링크1 </a>
                    </li>
                    <li>
                        <a class='bg-dark text-white h5 nav-link' href='/dashBoard'>링크2 </a>
                    </li>
                </div>
            </div>
        </div>
        @yield('content')
    </div>
        @show

    </body>
</html>
