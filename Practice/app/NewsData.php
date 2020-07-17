<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class NewsData extends Model
{
    public function insertNews($data){

        return \App\NewsData::insert(
            [
                'news_date' => $data[0],
                'news_title' => $data[1],
                'news_url' => $data[2]
            ]
        );

    }

    public function getNews(){
        // date("Y-m-d") 현재 날짜
        // 현재기준 일주일 전
        // print(date('Y-m-d',strtotime('-7 days')));

        // 오늘 기준 일주일동안의 news select
        return \App\NewsData::select('*')
            ->where('news_date','>',date('Y-m-d',strtotime('-7 days')))
            ->get();

    }
}
