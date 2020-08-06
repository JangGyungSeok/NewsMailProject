@extends('layouts.basic')

<script src="{{ asset('js/home.js') }}" defer></script>
@section('content')
    <div id='mailSendLogData' style='display:none'>
    </div>

    <div id='allReceiversData' style='display:none'>
    </div>

    <div class="row">
        <div class="col-md-6">
            <p class='display-4 text-center'>메일발송현황</p>
            <canvas id='mailSendLogChart'>
            </canvas>
        </div>

        <div class="col-md-6">
            <p class='display-4 text-center'>사용자 선호시간대 현황 </p>
            <canvas id='receiversChart'>
            </canvas>
        </div>
    </div>
@endsection
