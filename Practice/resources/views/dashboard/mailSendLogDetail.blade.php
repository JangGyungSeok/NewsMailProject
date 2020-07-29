@extends('layouts.basic')
<script src="{{ asset('js/mailSendLogDetail.js') }}" defer></script>

@section('content')
    <div class='row row-cols-2 col-md-12 no-gutters'>

        <div class='col-6 justify-content-center no-gutters' id='mailContent'>
            {!!$mailContent!!}
            {{-- {{$mailContent}} --}}
        </div>
        <div class='col-6 justify-content-center no-gutters'>
            {{-- {{ $receiveTimeLogDetail }} --}}
            <table class="table" name='mailSendLog'>
                <thead class='thead-dark'>
                    <th scope='col'>메일날짜</th>
                    <th scope='col'>uid</th>
                    <th scope='col'>email</th>
                    <th scope='col'>사용자 유입시간</th>
                </thead>
                <tbody data-field='{{ json_encode($receiveTimeLogDetail) }}' id='receiveTimeLogTable'>
                    @foreach ($receiveTimeLogDetail as $log)
                        <tr>
                            <th>{{$log->mail_date}} </th>
                            <td>{{$log->uid}} </td>
                            <td>{{$log->email}} </td>
                            <td>{{$log->enter_time}} </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class='col-12'>
            페이징넣을부분
        </div>


    </div>
@endsection
