@extends('layouts.basicArchitecture')

<script src="{{ asset('js/home.js') }}" defer></script>
@section('content')
    <div id='mailSendLogData' style='display:none'>
    </div>

    <div id='allReceiversData' style='display:none'>
    </div>

    <div class="row border">
        <div class='display-4 col-sm-12'>
            <a href='/dashBoard/mailSendLog'>메일발송현황</a>
        </div>
        <canvas id='mailSendLogChart'>
        </canvas>
    </div>

    <div class="row border">
        <p class='display-4 col-sm-12'>
            <a href='/dashBoard/receivers'>사용자 선호시간대 현황</a>
        </p>
        <canvas id='receiversChart'>
        </canvas>
    </div>
    @endsection
