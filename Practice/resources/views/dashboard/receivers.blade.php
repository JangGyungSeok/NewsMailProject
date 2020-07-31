@extends('layouts.basic')

<script src="{{ asset('js/dashboard.js') }}" defer></script>
@section('content')
    <div class='container col-md-12 no-gutters'>
        {{-- {{ json_encode($mailSendLog) }} --}}
        <table class="table" id='allReceiver' data-all-news='{{ json_encode($allReceiver) }}'>
            {{-- {{ $mailSendLog }} --}}
            <thead class='thead-dark'>
                <th scope='col'>idx</th>
                <th scope='col'>이메일</th>
                <th scope='col'>이름</th>
                <th scope='col'>메일발송예약시간</th>
            </thead>
            <tbody>
                @foreach ($allReceiver as $receiver)
                    <tr>
                        <td> {{$receiver->idx}} </td>
                        <td> {{$receiver->email}} </td>
                        <td> {{$receiver->name}} </td>
                        <td> {{$receiver->send_reservation_time}} </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
