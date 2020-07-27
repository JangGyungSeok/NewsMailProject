<?php

namespace App\Service;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Repository\ReceiveTimeLogRepository;
use App\Repository\ReceiverRepository;
use \App\Telegram;


class GatewayService
{
    private $receiverRepository;
    private $receiveTimeLogRepository;

    public function __construct(ReceiverRepository $receiverRepository,ReceiveTimeLogRepository $receiveTimeLogRepository)
    {
        $this->receiverRepository = $receiverRepository;
        $this->receiveTimeLogRepository = $receiveTimeLogRepository;
    }


    // 요청 정보를 확인할 수 있는 Request객체를 사용
    public function enterGateway(Request $request){
        $uid = $request->query('uid');
        $url = $request->query('url');
        $mailDate = $request->query('mailDate');

        // Log::info($request -> query('url'));
        // 수신자 확인 로직 실행
        // 수신자별 접근시간 적재로직 실행

        // ReceiverRepository Model의 메서드 사용 uid존재여부 확인
        Log::info('사용자 메일 접근');
        if ($uid == '0'){ // 대시보드에서 접근할 때 uid=0 즉 관리자
            return Redirect($url);
        }

        if ($this->receiverRepository->isReceiver($uid)) {
            // 메일 접근 로그 적재 실행
            Log::info('접근 유저 정보',['id'=>$uid]);
            $this->receiveTimeLogRepository->insertLog($uid,$mailDate);

            return Redirect($url);
        }else {
            return '사용자가 아닙니다.';
        }

    }
}
