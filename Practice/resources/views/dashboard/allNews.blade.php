@extends('layouts.basicArchitecture')

@section('content')
    <div class='container col-md-12 no-gutters'>
        {{-- {{ json_encode($mailSendLog) }} --}}
        <table class="table table-hover" id='allNews'>
            {{-- {{ $mailSendLog }} --}}
            <thead class='thead-dark'>
                <th scope='col'>idx</th>
                <th scope='col'>뉴스 날짜</th>
                <th scope='col'>제목</th>
                <th scope='col'>URL</th>
            </thead>
            <tbody>
                @foreach ($allNews as $news)
                    <tr>
                        <td> {{$news->news_idx}} </td>
                        <td> {{$news->news_date}} </td>
                        <th> {{$news->news_title}} </th>
                        <td> <a href='{{$news->news_url}}' target='_blank'>{{$news->news_url}}</a> </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $allNews->links() }}
@endsection
