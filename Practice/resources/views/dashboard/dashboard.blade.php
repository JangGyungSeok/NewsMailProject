@extends('layouts.basicArchitecture')

<script src="{{ asset('js/dashboard.js') }}" defer></script>
@section('content')
    <div class='row no-gutters'>
        {{-- {{ json_encode($mailSendLog) }} --}}
        <table class="table table-hover" id='mailSendLogTable'>
            {{-- {{ $mailSendLog }} --}}
            <thead class='thead-dark'>
                <th scope='col'>발송일</th>
                <th scope='col'>상세내용</th>
                <th scope='col'>대상자 수</th>
                <th scope='col'>발송 성공</th>
                <th scope='col'>발송 실패</th>
            </thead>
            <tbody id='mailSendLogTableBody'>
                @foreach ($mailSendLog as $log)
                    <tr onClick ="location.href='/dashBoard/mailSendLog/mailSendLogDetail/{{$log->mail_date}}'">
                        <th> {{$log->mail_date}} </th>
                        <td> <a href='/dashBoard/mailSendLog/mailSendLogDetail/{{$log->mail_date}}'>상세보기</a> </td>
                        <td> {{$log->total_send}} </td>
                        <td> {{$log->send_success}} </td>
                        <td> {{$log->send_fail}} </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class='row no-gutters'>
        <canvas id='mailSendLogChart'>

        </canvas>
    </div>
@endsection
