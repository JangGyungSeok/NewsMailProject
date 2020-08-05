@extends('layouts.basic')

<script src="{{ asset('js/receivers.js') }}" defer></script>
@section('content')
    <div class='container col-md-12 no-gutters'>
        {{-- {{ json_encode($mailSendLog) }} --}}
        <table class="table" id='receiversTable' data-all-receivers='{{ json_encode($allReceiver) }}'>
            {{-- {{ $mailSendLog }} --}}
            <thead class='thead-dark'>
                <th scope='col'>idx</th>
                <th scope='col'>이메일</th>
                <th scope='col'>이름</th>
                <th scope='col'>메일발송예약시간</th>
            </thead>
            <tbody id='receiversTableBody'>
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

    <div class='col-md-6 no-gutters'>
        <canvas id='receiversChart'>
        </canvas>
    </div>
@endsection
