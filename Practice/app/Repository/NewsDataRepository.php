<?php

namespace App\Repository;
use App\NewsData;
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
            ->get();
    }
}
