@extends('layouts.basic')

@section('content')
    <div class='container col-md-12 no-gutters'>
        <table class="table" name='mailSendLog'>
            {{-- {{ $mailSendLog }} --}}
            <thead class='thead-dark'>
                <th scope='col'>발송일</th>
                <th scope='col'>상세내용</th>
                <th scope='col'>대상자 수</th>
                <th scope='col'>발송 성공</th>
                <th scope='col'>발송 실패</th>
            </thead>
            <tbody>
                @foreach ($mailSendLog as $log)
                    <tr>
                        <th> {{$log->mail_date}} </th>
                    <td> <a href='/dashboard/mailSendLogDetail/{{$log->mail_date}}'>상세보기</a> </td>
                        <td> {{$log->total_send}} </td>
                        <td> {{$log->send_success}} </td>
                        <td> {{$log->send_fail}} </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
