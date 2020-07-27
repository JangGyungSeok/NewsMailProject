<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href={{asset('/css/app.css')}} rel='stylesheet'>
    </head>
    <body>
        <table class="table" name='mailSendLog'>
            <thead class='thead-dark'>
                <th scope='col'>번호</th>
                <th scope='col'>메일날짜</th>
                <th scope='col'>사용자</th>
                <th scope='col'>사용자 유입시간</th>
            </thead>
            <tbody>
                @foreach ($receiveTimeLogDetail as $log)
                    <tr>
                        <td>{{$log->idx}} </td>
                        <td>{{$log->mail_date}} </td>
                        <td>{{$log->uid}} </td>
                        <td>{{$log->enter_time}} </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </body>
</html>
