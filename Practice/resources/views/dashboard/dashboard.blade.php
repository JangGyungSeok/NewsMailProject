<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href={{asset('/css/app.css')}} rel='stylesheet'>
    </head>
    <body>
        <table class="table" name='mailSendLog'>
            {{ $mailSendLog }}
            <thead class='thead-dark'>
                <th scope='col'>번호</th>
                <th scope='col'>발송일</th>
                <th scope='col'>상세내용</th>
                <th scope='col'>대상자 수</th>
                <th scope='col'>발송 성공</th>
                <th scope='col'>발송 실패</th>
            </thead>
            <tbody>

                {{-- @foreach ($mailSendLog as $log)
                    <tr>
                        <th> {{$log->idx}} </th>
                        <td> {{$log->send_time}} </td>
                        <td> {{$log->uid}} </td>
                    </tr>
                @endforeach --}}
            </tbody>
        </table>
    </body>
</html>
