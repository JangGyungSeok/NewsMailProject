<?php

namespace App\Service;

use App\Repository\NewsDataRepository;
use Goutte\Client;
use Illuminate\Support\Facades\Log;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\HttpClient\Exception\TransportException;

class CrawlerService
{
    private $newsDataRepository;

    public function __construct(NewsDataRepository $newsDataRepository)
    {
        $this->newsDataRepository = $newsDataRepository;
    }

    public function CrawlingNews(){
        $client = new Client();
        $page = 1;
        $count = 0;

        while(true){
            try{
                    // http://www.hkrecruit.co.kr/news/articleList.html?page=1&total=593&box_idxno=&sc_area=A&view_type=sm&sc_word=%EC%82%AC%EB%9E%8C%EC%9D%B8
                $url = 'http://www.hkrecruit.co.kr/news/articleList.html?page='.(string)$page.'&total=593&box_idxno=&sc_area=A&view_type=sm&sc_word=%EC%82%AC%EB%9E%8C%EC%9D%B8';

                $crawler = $client->request('GET',$url);

                $links = $crawler
                    ->filter('#user-container > div.float-center.max-width-1080 > div.user-content > section > article > div.article-list > section > div.list-block');
                if ($links->text() == null){
                    Log::info('여기들어옴');
                    return 'NoContent';
                }

                foreach($links as $link){
                    if($count == 100) {
                            Log::info('10개의 기사 크롤링 완료');
                            return 'Success';
                    }
                    $temp = new Crawler($link);

                    // 크롤링할 기사 날짜 확인
                    $newsDate = explode("|", $temp->filter('div.list-dated')->text())[2];
                    $newsDate = explode(' ', $newsDate)[1];

                    if( strtotime($newsDate) == strtotime(date('Y-m-d', strtotime('-1 days'))) ){
                        $count++;
                        // 기사 제목, URL 크롤링
                        $temp_title = $temp->filter('div.list-titles > a > strong')->text();
                        $temp_url = 'http://www.hkrecruit.co.kr'.$temp->filter('div.list-titles > a')->attr('href');

                        //DB 적재로직 실행

                        $this->newsDataRepository->insertNews(
                            array(
                                $newsDate,
                                $temp_title,
                                $temp_url,
                            )
                        );

                    } elseif (strtotime($newsDate) >= strtotime(date('Y-m-d'))) {
                        continue;
                    }
                    else {
                        if ($count == 0) {
                            // 오늘자 기사 없을 시 텔레그램 메시지
                            Log::info('크롤링 할 기사 없음');
                            return 'Success';
                        }
                        else{
                            Log::info((string)$count.'개의 기사 크롤링 완료');
                            return 'Success';
                        }
                    }
                }
                $page++;

            } catch(\Exception $e){
                // url이 비정상인경우 발생
                if($e instanceof TransportException){
                    Log::info('URL경로가 잘못되었습니다.');
                    return 'CrawlingURLFail';
                } elseif ($e instanceof \RuntimeException){
                    return 'NotGoodCssSelector';
                }
                return 'ChangedArchitecture';
            } //catch
        } //while
    }
}
