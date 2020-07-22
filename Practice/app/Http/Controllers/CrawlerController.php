<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Snoopy;
use Goutte\Client;
use App\NewsData;
use Illuminate\Support\Facades\Log;
use Symfony\Component\DomCrawler\Crawler;

class CrawlerController extends Controller
{
    protected $news_data;

    public function __construct(NewsData $news_data)
    {
        $this->news_data = $news_data;
    }


    public function crawlingNews(){
        $client = new Client();
        $page = 1;
        $count = 0;

        while(true){
            // http://www.hkrecruit.co.kr/news/articleList.html?page=1&total=593&box_idxno=&sc_area=A&view_type=sm&sc_word=%EC%82%AC%EB%9E%8C%EC%9D%B8
            $url = 'http://www.hkrecruit.co.kr/news/articleList.html?page='.(string)$page.'&total=593&box_idxno=&sc_area=A&view_type=sm&sc_word=%EC%82%AC%EB%9E%8C%EC%9D%B8';
            $crawler = $client->request('GET',$url);
            $links = $crawler
                ->filter('#user-container > div.float-center.max-width-1080 > div.user-content > section > article > div.article-list > section > div.list-block');

            foreach($links as $link){
                if($count == 10) {
                        Log::info('10개의 기사 크롤링 완료');
                        return true;
                }
                $temp = new Crawler($link);

                // 크롤링할 기사 날짜 확인
                $newsDate = explode("|", $temp->filter('div.list-dated')->text())[2];
                $newsDate = explode(' ', $newsDate)[1];

                // if($newsDate == date('Y-m-d')){
                if($newsDate == '2020-07-15'){
                    $count++;
                    // 기사 제목, URL 크롤링
                    $temp_title = $temp->filter('div.list-titles > a > strong')->text();
                    $temp_url = 'http://www.hkrecruit.co.kr'.$temp->filter('div.list-titles > a')->attr('href');

                    //DB 적재로직 실행
                    $this->news_data->insertNews(
                        array(
                            $newsDate,
                            $temp_title,
                            $temp_url
                        )
                    );

                } else {
                    if ($count == 0) {
                        // 오늘자 기사 없을 시 텔레그램 메시지
                        Log::info('크롤링 할 기사 없음');
                        return false;
                    }
                    else{
                        Log::info((string)$count.'개의 기사 크롤링 완료');
                        return true;
                    }
                }
            }
            $page++;
        }
    }

}
