<?php

namespace App\Service;

use App\MailSendLog;
use Illuminate\Http\Request;
use \App\NewsData;
use Illuminate\Support\Facades\Log;
use \GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;

class MailSendService
{
    private $newsData;
    private $mailSendLog;

    public function __construct(NewsData $newsData, MailSendLog $mailSendLog)
    {
        $this->newsData = $newsData;
        $this->mailSendLog = $mailSendLog;
    }

    public function getMailContent($uid){
        $emailContent = '<h1> 사람인 관련 기사 </h1> <br>';
        // Model에 정의해둔 select 로직인 getNews() 메서드 사용
        foreach($this->newsData->getNews() as $data){
            $query = http_build_query(
                array(
                    'url' => $data->news_url,
                    'uid' => $uid,
                    'mailDate' => date('Y-m-d')
                )
                , '&amp'
            );
            // a태그 query로 redirect url과 사용자 idx, token 전달 (수신자 db정의, 수신자 정보 전달받은 이후 가능)
            $emailContent =$emailContent.'<a href=http://172.18.128.1/gateway?'.$query.' target=_blank> <h1>'.$data->news_title.'</h1></a><br>';
        }

        return $emailContent;
    }

    // 메일발송 메서드 정의
    public function sendMail($userData){

        // 메일 컨텐츠 동적생성 - 동작성공 (다듬기 미완성)
        // 내용물 생성 완료! (일주일 이전 ~ 현재 기사를 DB에서 읽어옴)
        Log::info('메일발송 API 실행',['수신자 uid' => $userData->idx]);
        $emailContent = $this->getMailContent($userData->idx);

        // 메일발송 API 사용
        $mail_api_url = "http://crm3.saramin.co.kr/mail_api/automails";
        $client = new Client;
        $response = $client->post(
            $mail_api_url,
            [
                'form_params'=>
                    [
                    'autotype'=>'A0188',
                    'cmpncode'=>'12031',
                    'email'=>$userData->email,
                    'sender_email'=> $userData->email,
                    // 사용자 이름이 필요할 것으로 생각됨
                    'title' => $userData->name.'님 '.date("Y-m-d").' 사람인 관련 기사입니다.',
                    'use_event_solution'=>'y',
                    'replace15' => $emailContent
                    ]
            ]
        );
        return $response->getStatusCode();
    }
}
