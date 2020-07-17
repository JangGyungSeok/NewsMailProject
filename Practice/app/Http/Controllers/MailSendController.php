<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MailSendController extends Controller
{

    // 메일발송 메서드 정의
    public function sendMail(){

        // 방법 1 시작  -> 미작동
        // $mail_api_url = "http://crm3.saramin.co.kr/mail_api/automails";
        // $client = new \GuzzleHttp\Client();
        // $response = $client->request("POST",
        //     $mail_api_url,
        //         Request::json(
        //         [
        //             'autotype'=>'A0188',
        //             'cmpncode'=>'12031',
        //             'email'=>'JKS@saramin.co.kr',
        //             'sender_email'=>'JKS@saramin.co.kr',
        //             'title' => 'test mail',
        //             'use_event_solution'=>'y',
        //             'replace15' => 'CONTENT'
        //         ]
        //         )
        // );
        // print($response->getStatusCode());
        // print($response->getbody());
        // 방법 1 끝

        // 방법 2 시작 -성공
        // 파라미터로 id관련 정보를 받아 메일을 보낼 예정이다.
        $mail_api_url = "http://crm3.saramin.co.kr/mail_api/automails";
        $client = new \GuzzleHttp\Client();
        $response = $client->post($mail_api_url,
                        ['form_params'=>
                        [
                        'autotype'=>'A0188',
                        'cmpncode'=>'12031',
                        'email'=>'JKS@saramin.co.kr',
                        'sender_email'=>'JKS@saramin.co.kr',
                        'title' => 'test mail',
                        'use_event_solution'=>'y',
                        'replace15' => 'CONTENT'
                        ]]
                    );
        // 방법 2 끝

        print($response->getbody());



    }
}
