<?php

namespace App\Service;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use \App\ReceiveTimeLog;
use \App\Receiver;
use \App\Telegram;


class GatewayService
{
    private $receiver;
    private $receiveTimeLog;

    public function __construct(Receiver $receiver,ReceiveTimeLog $receiveTimeLog)
    {
        $this->receiver = $receiver;
        $this->receiveTimeLog = $receiveTimeLog;
    }


    // 요청 정보를 확인할 수 있는 Request객체를 사용
    public function enterGateway(Request $request){


        // Log::info($request -> query('url'));
        // 수신자 확인 로직 실행
        // 수신자별 접근시간 적재로직 실행

        // Receiver Model의 메서드 사용 uid존재여부 확인
        Log::info('사용자 메일 접근');
        if ($this->receiver->isReceiver($request -> query('uid'))) {
            // 메일 접근 로그 적재 실행
            Log::info('접근 유저 정보',['id'=>$request -> query('uid')]);
            $this->receiveTimeLog->insertLog($request -> query('uid'),$request -> query('mailDate'));

            return Redirect($request -> query('url'));
        } else{
            return '사용자가 아닙니다.';
        }

    }
}
