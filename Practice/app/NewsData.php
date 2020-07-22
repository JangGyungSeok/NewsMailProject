<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NewsData extends Model
{
    public function insertNews($data){
        return NewsData::insert(
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
        return NewsData::select('*')
            ->where('news_date','>',date('Y-m-d',strtotime('-20 days')))
            ->get();

    }

    public function getMailContent($uid){
        $emailContent = '<h1> 사람인 관련 기사 </h1> <br>';
        // Model에 정의해둔 select 로직인 getNews() 메서드 사용
        foreach($this->getNews() as $data){
            $query = http_build_query(
                array(
                    'url' => $data->news_url,
                    'uid' => $uid,
                    'mailDate' => date('Y-m-d')
                )
                , '&amp'
            );

            dump($data);
            // a태그 query로 redirect url과 사용자 idx, token 전달 (수신자 db정의, 수신자 정보 전달받은 이후 가능)
            $emailContent =$emailContent.'<a href=http://172.18.128.1/gateway?'.$query.' target=_blank> <h1>'.$data->news_title.'</h1></a><br>';
        }
        dump($emailContent);

        return $emailContent;
    }
}
