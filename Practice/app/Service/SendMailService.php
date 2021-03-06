<?php

namespace App\Service;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Exceptions\CustomException;
use App\Exceptions\MailAPIFailException;
use App\Exceptions\MailFailException;
use App\Exceptions\MailSendFailException;
use App\Repository\NewsDataRepository;
use App\Repository\MailSendLogRepository;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Exception\ConnectException;

class SendMailService
{
    private $newsDataRepository;
    private $mailSendLogRepository;

    public function __construct(
        NewsDataRepository $newsDataRepository,
        MailSendLogRepository $mailSendLogRepository
    ) {
        $this->newsDataRepository = $newsDataRepository;
        $this->mailSendLogRepository = $mailSendLogRepository;
    }

    // 메일발송 메서드 정의
    public function sendMail($userData)
    {

        // 메일 컨텐츠 동적생성 - 동작성공 (다듬기 미완성)
        // 내용물 생성 완료! (일주일 이전 ~ 현재 기사를 DB에서 읽어옴)
        Log::info('메일발송 API 실행',['수신자 uid' => $userData->idx]);


        // 메일발송 API 사용
        $mail_api_url = "http://crm3.saramin.co.kr/mail_api/automails";
        $client = new Client;
        try {
            $emailContent = $this->newsDataRepository->getMailContentByDate(date('Y-m-d'),$userData->idx);
            $response = $client->post(
                $mail_api_url,
                [
                    'form_params'=>
                        [
                        'autotype'=>'A0188',
                        'cmpncode'=>'12031',
                        'email'=>$userData->email,
                        'sender_email'=> $userData->email,
                        'title' => $userData->name.'님 '.date("Y-m-d").' 사람인 관련 기사입니다.',
                        'use_event_solution'=>'y',
                        'replace15' => $emailContent
                        ]
                ]
            );
        } catch (Exception $e) {
            if ($e instanceof ConnectException) {
                throw new MailAPIFailException();
            }
            throw new MailFailException();
        }


        try {
            if ($response->getStatusCode() == 200) {
                if (json_decode($response->getBody()->getContents())->code == '200') {
                    // 메일발송 성공 로그 적재
                    $this->mailSendLogRepository->insertLog($userData->idx, true);

                    return true;
                } else {
                    // 메일발송 실패 로그 적재, 텔레그램
                    $this->mailSendLogRepository->insertLog($userData->idx, false);

                    throw new MailSendFailException();
                }
            } else {
                throw new MailAPIFailException();
            }
        } catch (Exception $e) {
            report($e);
        }

    }

}
