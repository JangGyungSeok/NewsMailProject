<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href={{asset('css/app.css')}} rel='stylesheet'>
        <link href={{asset('css/custom.css')}} rel='stylesheet'>
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
        <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    </head>
    <body style='height: 94vh'>
        <div class='container-fluid' style='height: 100%'>
            {{-- 네이게이션 바 (화면 최상단) --}}
            <div class='row'>
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
            </div>

            {{-- 좌측 메뉴바, 우측 컨텐츠 영역 --}}
            <div class='row h-100'>
                {{-- 메뉴바 --}}
                <div class='col-md-3 border-right'>
                    <ul class ='list-group shadow mt-5'>
                        <a href='/dashBoard' class='list-group-item list-group-item-action'>
                            메인 화면
                        </a>
                        <a href='/dashBoard/allNews' class='list-group-item list-group-item-action'>
                            전체 뉴스
                        </a>
                        <a href='/dashBoard/mailSendLog' class='list-group-item list-group-item-action'>
                            메일 발송현황
                        </a>
                        <a href='/dashBoard/receivers' class='list-group-item list-group-item-action'>
                            메일 수신자 현황
                        </a>
                    </ul>
                </div>

                {{-- 컨텐츠 영역 --}}
                <div class='col-md-9 mt-5'>
                    @yield('content')
                </div>
            </div>
        </div>
        @show

    </body>
</html>
