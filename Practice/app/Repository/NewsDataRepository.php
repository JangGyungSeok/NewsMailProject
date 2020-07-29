<?php

namespace App\Repository;

use App\NewsData;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class NewsDataRepository
{

    protected $newsData;

    public function __construct(NewsData $newsData)
    {
        $this->newsData = $newsData;
    }

    public function insertNews($data)
    {
        return $this->newsData->insert(
            [
                'news_date' => $data[0],
                'news_title' => $data[1],
                'news_url' => $data[2]
            ]
        );

    }

    public function getNews()
    {
        // 오늘 기준 일주일동안의 news select
        return $this->newsData->select('*')
            ->where('news_date','>=',date('Y-m-d',strtotime('-7 days')))
            ->where('news_date','<',date('Y-m-d'))
            ->get();
    }



    public function getMailContentByDate($news_date, $uid=0)
    {
        $emailContent = '<table class="table">
                            <thead class="thead-dark">
                                <th scope="col"> 기사 제목 </th>
                            </thead>
                                <tbody>';
        foreach ($this->getNewsByDate($news_date) as $data) {
            $query = http_build_query(
                array(
                    'url' => $data->news_url,
                    'uid' => $uid,
                    'mailDate' => date('Y-m-d')
                ),
                '&amp'
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

    public function checkNews(){
        return $this->newsData
            ->where('news_date','>=',date('Y-m-d',strtotime('-7 days')))
            ->where('news_date','<',date('Y-m-d'))
            ->exists();
    }
}
