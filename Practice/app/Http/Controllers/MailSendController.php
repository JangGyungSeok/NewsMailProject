<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use \App\NewsData;
use Illuminate\Support\Facades\Log;

class MailSendController extends Controller
{
    protected $news_data;



    public function __construct(NewsData $news_data)
    {
        $this->news_data = $news_data;
    }

    public function test($data){
        Log::info("테스트성공".$data);
    }

    // 메일발송 메서드 정의
    public function sendMail($userData){

        // 메일 컨텐츠 동적생성 - 동작성공 (다듬기 미완성)
        // 내용물 생성 완료! (일주일 이전 ~ 현재 기사를 DB에서 읽어옴)
        $emailContent = '<h1> 사람인 관련 기사 </h1> <br>';
        // Model에 정의해둔 select 로직인 getNews() 메서드 사용
        foreach($this->news_data->getNews() as $data){
            // a태그 query로 redirect url과 사용자 idx, token 전달 (수신자 db정의, 수신자 정보 전달받은 이후 가능)
            $emailContent =$emailContent.'<a href=http://172.18.128.1/gateway?url='.$data->news_url.' target=_blank> <h1>'.$data->news_title.'</h1></a><br>';
        }


        // 메일발송 API 사용
        $mail_api_url = "http://crm3.saramin.co.kr/mail_api/automails";
        $client = new \GuzzleHttp\Client();
        $response = $client->post(
            $mail_api_url,
            [
                'form_params'=>
                    [
                    'autotype'=>'A0188',
                    'cmpncode'=>'12031',
                    'email'=>'JKS@saramin.co.kr',
                    'sender_email'=> $userData->email,
                    // 사용자 이름이 필요할 것으로 생각됨
                    'title' => 'test mail',
                    'use_event_solution'=>'y',
                    'replace15' => $emailContent
                    ]
            ]
        );

        return true;

    }
}
