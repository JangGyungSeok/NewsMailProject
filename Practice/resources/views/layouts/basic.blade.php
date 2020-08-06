<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href={{asset('css/app.css')}} rel='stylesheet'>
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
        <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
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
                        <a class='bg-dark text-white h5 nav-link' href='/dashBoard/allNews'>전체뉴스 </a>
                    </li>
                    <li>
                        <a class='bg-dark text-white h5 nav-link' href='/dashBoard/mailSendLog'>메일발송현황 </a>
                    </li>
                    <li>
                        <a class='bg-dark text-white h5 nav-link' href='/dashBoard/receivers'>사용자 정보 </a>
                    </li>
                </div>
            </div>
        </div>
        @yield('content')
    </div>
        @show

    </body>
</html>
