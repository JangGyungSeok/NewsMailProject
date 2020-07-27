@extends('layouts.basic')

@section('content')
    <div class='row row-cols-2 col-md-12 no-gutters'>

        <div class='col-6 justify-content-center no-gutters'>
            {!! $mailContent !!}
        </div>
        <div class='col-6 justify-content-center no-gutters'>
            <table class="table" name='mailSendLog'>
                <thead class='thead-dark'>
                    <th scope='col'>메일날짜</th>
                    <th scope='col'>사용자</th>
                    <th scope='col'>사용자 유입시간</th>
                </thead>
                <tbody>
                    @foreach ($receiveTimeLogDetail as $log)
                        <tr>
                            <th>{{$log->mail_date}} </th>
                            <td>{{$log->uid}} </td>
                            <td>{{$log->enter_time}} </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class='col-12'>
            1 2 3
        </div>

    </div>
@endsection
