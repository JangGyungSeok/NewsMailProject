<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Snoopy;
use Goutte\Client;
use App\NewsData;
class CrawlerController extends Controller
{
    protected $news;

    public function __construct(NewsData $news)
    {
        $this->news = $news;
    }


    public function crawlingNews(NewsData $news){
        $client = new Client();
        // 'http://www.hkrecruit.co.kr/'
        // $crawler = $client->submit(
        //     $crawler->filter('#user-nav-wrapper > fieldset > form > button')->form(),
        //     array('sc_word'=>'사람인')
        // );

        $isToday = true;
        $page =1;
        // $isToday 로 변경할 예정
        while($page <4){
            $url = 'http://www.hkrecruit.co.kr/news/articleList.html?page='.(string)$page.'&total=593&box_idxno=&sc_area=A&view_type=sm&sc_word=%EC%82%AC%EB%9E%8C%EC%9D%B8';
            // print($url);
            $crawler = $client->request('GET',$url);
            $page++;
            $links = $crawler->filter('#user-container > div.float-center.max-width-1080 > div.user-content > section > article > div.article-list > section > div.list-block')->each(function($node){
            // 날짜확인 로직 시작
            $newsDate = explode("|", $node->filter('div.list-dated')->text())[2];
            $newsDate = explode(' ', $newsDate)[1];

            // 오늘 날짜와 비교하는 조건문
            // date("Y-m-d") -> 서버시간을 기준으로 문자열 생성
            // if(date("Y-m-d") == $newsDate){
            return array($newsDate
                ,$node->filter('div.list-titles > a > strong')->text()
                ,'http://www.hkrecruit.co.kr'.$node->filter('div.list-titles > a')->attr('href'),
                );
            // }else{
            //     $isToday = false;
            // }
            // 날짜확인 로직 끝

            });


            foreach($links as $link){
                // $this->news->insertNews($link);
                print($link[0]);
            }

        }

        //테스트용 내용물 출력 (URL과 제목)

    }

}
