<?php

namespace App\Repository;
use App\NewsData;
use Illuminate\Support\Facades\Log;

class NewsDataRepository{

    protected $newsData;

    public function __construct(NewsData $newsData)
    {
        $this->newsData = $newsData;
    }

    public function insertNews($data){
        return $this->newsData->insert(
            [
                'news_date' => $data[0],
                'news_title' => $data[1],
                'news_url' => $data[2]
            ]
        );

    }

    public function getNews(){
        // 오늘 기준 일주일동안의 news select
        return $this->newsData->select('*')
            ->where('news_date','>=',date('Y-m-d',strtotime('-7 days')))
            ->where('news_date','<',date('Y-m-d'))
            ->get();
    }

    // <table class='thead-dark'>
    //     <thead class='thead-dark'>
    //         <th scope='col'> 기사 제목 </th>
    //     </thead>
    //     <tbody>
    //         내용물
    //     </tbody>
    // </table>
    public function getMailContentByDate($news_date, $uid=0){

        // $emailContent = '<h1> 사람인 관련 기사 </h1> <br>';
        // // Model에 정의해둔 select 로직인 getNews() 메서드 사용
        // foreach($this->news_data->getNewsByDate($news_date) as $data){
        //     $query = http_build_query(
        //         array(
        //             'url' => $data->news_url,
        //             'uid' => $uid,
        //             'mailDate' => date('Y-m-d')
        //         )
        //         , '&amp'
        //     );
        //     // a태그 query로 redirect url과 사용자 idx, token 전달 (수신자 db정의, 수신자 정보 전달받은 이후 가능)
        //     $emailContent =$emailContent.'<a href=http://172.20.38.69/gateway?'.$query.' target=_blank> <h1>'.$data->news_title.'</h1></a><br>';
        // }

        $emailContent = '<table class="table">
                            <thead class="thead-dark">
                                <th scope="col"> 기사 제목 </th>
                            </thead>
                                <tbody>';
        foreach($this->getNewsByDate($news_date) as $data){
            $query = http_build_query(
                array(
                    'url' => $data->news_url,
                    'uid' => $uid,
                    'mailDate' => date('Y-m-d')
                )
                , '&amp'
            );
            $emailContent = $emailContent.'<tr> <th> <a href="http://172.20.38.69/gateway?'.$query.'" target=_blank>'.$data->news_title.'</a></th></tr>';
        }
        $emailContent = $emailContent.'</tbody></table>';

        // Log::info($emailContent);
        return $emailContent;
    }

    public function getNewsByDate($news_date)
    {
        // Log::info(date($news_date, strtotime('-7 days')));
        // Log::info(date('Y-m-d',strtotime($news_date.' -7 days')));
        return $this->newsData->select('*')
            ->where(
                [
                    ['news_date','>=',date('Y-m-d',strtotime($news_date.' -7 days'))],
                    ['news_date','<=',date($news_date)]
                ]
            )
            ->get();
    }
}
