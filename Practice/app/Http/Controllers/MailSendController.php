<?php

namespace App\Http\Controllers;

use App\MailSendLog;
use Illuminate\Http\Request;
use \App\NewsData;
use Illuminate\Support\Facades\Log;
use phpDocumentor\Reflection\Types\Boolean;
use \GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;

class MailSendController extends Controller
{
    private $newsData;
    private $mailSendLog;



    public function __construct(NewsData $newsData, MailSendLog $mailSendLog)
    {
        $this->newsData = $newsData;
        $this->mailSendLog = $mailSendLog;
    }

    // 메일발송 메서드 정의
    public function sendMail($userData){

        // 메일 컨텐츠 동적생성 - 동작성공 (다듬기 미완성)
        // 내용물 생성 완료! (일주일 이전 ~ 현재 기사를 DB에서 읽어옴)
        Log::info('메일발송 API 실행',['수신자 uid' => $userData->idx]);
        $emailContent = $this->newsData->getMailContent($userData->idx);

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
                    'title' => 'test mail',
                    'use_event_solution'=>'y',
                    'replace15' => $emailContent
                    ]
            ]
        );
        return $response->getStatusCode();
    }
}
