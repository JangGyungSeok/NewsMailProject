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

    // 사람인 기사 적재
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

    // 일주일 간 기사 조회
    public function getNews()
    {
        // 오늘 기준 일주일동안의 news select
        return $this->newsData->select('*')
            ->where('news_date','>=',date('Y-m-d',strtotime('-7 days')))
            ->where('news_date','<',date('Y-m-d'))
            ->get();
    }

    // 날짜별 메일 컨텐츠 조회
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
                    'idx' => $data->news_idx,
                    'uid' => $uid,
                    'mailDate' => date('Y-m-d')
                ),
                '&'
            );
            $emailContent = $emailContent.'<tr> <th> <a href="http://172.20.38.69/gateway?'.$query.'" target=_blank>'.$data->news_title.'</a></th></tr>';
            // echo "test : ".$query;
        }
        $emailContent = $emailContent.'</tbody></table>';

        // Log::info($emailContent);
        return $emailContent;
    }

    // 날짜별 뉴스 조회
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

    // idx별 뉴스 조회
    public function getNewsByIdx($idx)
    {
        return $this->newsData
            ->select('*')
            ->where('news_idx',$idx)
            ->get();
    }

    // 변경, 삭제 기사 접근 시 changed로 변경로직
    public function changeUrl($idx)
    {
        return $this->newsData
            ->where('news_idx',$idx)
            ->update(['news_url'=>'changed']);
    }

    // 최근 일주일 기사 확인
    public function checkNews()
    {
        return $this->newsData
            ->where('news_date','>=',date('Y-m-d',strtotime('-7 days')))
            ->where('news_date','<',date('Y-m-d'))
            ->exists();
    }

    // 기사 전체조회
    public function getAll()
    {
        return $this->newsData
            ->orderBy('news_date','DESC')
            ->paginate();
    }
}
