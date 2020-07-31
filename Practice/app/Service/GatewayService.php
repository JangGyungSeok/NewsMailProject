<?php

namespace App\Service;

use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Exceptions\CustomException;
use App\Repository\NewsDataRepository;
use App\Repository\ReceiverRepository;
use App\Repository\ReceiveTimeLogRepository;
use Exception;
use Symfony\Component\HttpClient\Exception\TransportException;

use function GuzzleHttp\Psr7\parse_query;

class GatewayService
{
    private $receiverRepository;
    private $receiveTimeLogRepository;
    private $newsDataRepository;

    public function __construct(
        ReceiverRepository $receiverRepository,
        ReceiveTimeLogRepository $receiveTimeLogRepository,
        NewsDataRepository $newsDataRepository
    ) {
        $this->receiverRepository = $receiverRepository;
        $this->receiveTimeLogRepository = $receiveTimeLogRepository;
        $this->newsDataRepository = $newsDataRepository;
    }

    public function checkTitle($url)
    {
        # redirect 전 뉴스기사 페이지의 title을 받아온다.
        # 또한 DB의 title과 페이지의 title을 비교해 변경을 확인한다.
        try {
            $client = new Client();
            $crawler = $client->request('GET',$url);
            $title = $crawler->filter('#user-container > div.float-center.max-width-1080 > header > div > div')->text();
            if ($title == null) {
                Log::info('CSS Selector는 있으나 비어있음');
                throw new CustomException('NoContent');
            }
        } catch (Exception $e) {
            if ($e instanceof TransportException) {
                Log::info('URL경로가 잘못되었습니다.');
                throw new CustomException('404');
            } elseif ($e instanceof \RuntimeException) {
                throw new CustomException('NotGoodCssSelector');
            }
            throw new CustomException('ChangedArchitecture');
        }
        return $title;
    }

    // 요청 정보를 확인할 수 있는 Request객체를 사용
    public function enterGateway(Request $request)
    {
        $uid = $request->query('uid');
        $idx = $request->query('idx');
        $mailDate = $request->query('mailDate');

        $newsData = $this->newsDataRepository->getNewsByIdx($idx);
        $url = $newsData[0]->news_url;

        if ($url == 'changed') {
            return '뉴스기사가 변경 또는 삭제되었습니다.';
        }

        $title = $this->checkTitle($url);

        // title과 db의 title과 다를경우
        if ($title != $newsData[0]->news_title) {
            $this->newsDataRepository->changeUrl($idx);
            throw new CustomException('NewsIsChanged');
        } else {
            // DB내용과 실제 기사가 일치할경우
            if ($uid == '0'){ // 대시보드에서 접근할 때 uid=0 즉 관리자
                return Redirect($url);
            } elseif ($this->receiverRepository->isReceiver($uid)) { // 사용자가 접근한경우
                // 메일 접근 로그 적재 실행
                Log::info('접근 유저 정보',['id'=>$uid]);
                $this->receiveTimeLogRepository->insertLog($uid,$mailDate);

                return Redirect($url);
            } else { // uid가 DB에 존재하지않을경우
                throw new CustomException('NotReceiver');
                // return '사용자가 아닙니다.';
            }
        }
    }

}
