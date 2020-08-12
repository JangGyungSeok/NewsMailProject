<?php

namespace App\Service;

use App\Exceptions\crawlingURLFailException;
use App\Exceptions\CustomException;
use App\Exceptions\NoContentException;
use App\Exceptions\NotGoodCSSSelectorException;
use InvalidArgumentException;
use RuntimeException;
use Symfony\Component\HttpClient\Exception\TransportException;
use Illuminate\Contracts\Container\BindingResolutionException;

use Goutte\Client;
use Illuminate\Support\Facades\Log;
use App\Repository\NewsDataRepository;
use Illuminate\Container\Container;

use Symfony\Component\DomCrawler\Crawler;



class CrawlerService
{
    private $newsDataRepository;

    public function __construct(NewsDataRepository $newsDataRepository)
    {
        // $container = Container::getInstance();
        $this->newsDataRepository = $newsDataRepository;
        // $container->make(NewsDataRepository::class);
    }

    public function crawlingNews()
    {
        // Goutte 클라이언트
        $client = new Client();
        $page = 1;
        $count = 0;

        while (true) {
            try {
                    // http://www.hkrecruit.co.kr/news/articleList.html?page=1&total=593&box_idxno=&sc_area=A&view_type=sm&sc_word=%EC%82%AC%EB%9E%8C%EC%9D%B8
                $url = 'http://www.hkrecruit.co.kr/news/articleList.html?page='
                    .(string)$page.
                    '&total=593&box_idxno=&sc_area=A&view_type=sm&sc_word=%EC%82%AC%EB%9E%8C%EC%9D%B8';

                $crawler = $client->request('GET',$url);

                // 기사 컨텐츠 테이블 선택
                $links = $crawler
                    ->filter('#user-container > div.float-center.max-width-1080 > div.user-content > section > article > div.article-list > section > div.list-block');

                if ($links->text() == null) {
                    Log::info('CSS Selector는 있으나 비어있음');
                    throw new NoContentException();
                }

                // 기사 테이블 행별로 foreach
                foreach ($links as $link) {
                    if ($count == 10) {
                            Log::info('10개의 기사 크롤링 완료');
                            return true;
                    }
                    // Goutte가 내부적으로 DomCrawler로 이루어져있음
                    $temp = new Crawler($link);

                    // 크롤링할 기사 날짜 확인
                    $newsDate = explode("|", $temp->filter('div.list-dated')->text())[2];
                    $newsDate = explode(' ', $newsDate)[1];


                    if (strtotime($newsDate) == strtotime(date('Y-m-d', strtotime('-1 days')))) {
                        // Log::info('뉴스날짜',['left'=>strtotime($newsDate),'right'=>strtotime(date('2020-07-24', strtotime('-1 days')))]);
                        $count++;
                        // 기사 제목, URL 크롤링
                        $temp_title = $temp->filter('div.list-titles > a > strong')->text();
                        $temp_url = 'http://www.hkrecruit.co.kr'.$temp->filter('div.list-titles > a')->attr('href');

                        //DB 적재로직 실행

                        // Log::info(['날짜 '=>$newsDate,'제목'=>$temp_title,'url'=>$temp_url]);
                        $this->newsDataRepository
                            ->insertNews(
                                array(
                                    $newsDate,
                                    $temp_title,
                                    $temp_url,
                                )
                            );
                            // 뉴스기사가 내림차순으로 정렬되므로 어제일자보다 최신인경우 continue
                    } elseif (strtotime($newsDate) >= strtotime(date('Y-m-d'))) {
                        continue;
                    } else {
                        if ($count == 0) {
                            // 오늘자 기사 없을 시 텔레그램 메시지
                            Log::info('크롤링 할 기사 없음');
                            return true;
                        } else {
                            Log::info((string)$count.'개의 기사 크롤링 완료');
                            return true;
                        }
                    }
                }
                $page++;

            } catch (\Exception $e) {
                // url이 비정상인경우 발생
                if ($e instanceof TransportException) {
                    Log::info('URL경로가 잘못되었습니다.');
                    throw new CrawlingURLFailException();
                } elseif ($e instanceof InvalidArgumentException) {
                    throw new NotGoodCSSSelectorException();
                } elseif ($e instanceof RuntimeException) {
                    throw report($e);
                }
                throw $e;
                return false;
            } //catch
        } //while
    }
}
