<?php

namespace App\Service;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

define('BOT_TOKEN',env('TELEGRAM_BOT_TOKEN'));
define('API_URL','http://api.telegram.org/bot'.BOT_TOKEN.'/');

class TelegramService
{
    public function getMessageContent($situation)
    {
        switch($situation){
            // 뉴스포털 URL이 문제있는경우
            case 'CrawlingURLFail':
                $message = '크롤링할 페이지가 없습니다.';
                break;
            // 접근하는 CSSSeletor가 형식에 어긋날경우
            case 'NotGoodCSSSelector':
                $message = '잘못된 CSS Selector를 입력했습니다.';
                break;
            // 접근하고자 하는 element가 없는경우
            case 'ChangedArchitecture':
                $message = '크롤링할 페이지 구조가 변경되었습니다.';
                break;
            // element는 있으나 내용물이 없는경우
            case 'NoContent':
                $message = 'css selector에 맞는 컨텐츠가 없습니다.';
                break;
            // Mail 발송 API가 미작동하는 경우
            case 'MailAPIFail':
                $message = 'Mail발송 API가 동작하지 않습니다.';
                break;
            // Mail 발송 API는 작동하나 Mail발송이 실패한경우
            case 'MailSendFail':
                $message = '메일 발송이 실패했습니다.';
                break;
            // 메일발송에서 알수없는오류
            case 'MailFail':
                $message = '메일 발송에 알수없는 오류 발생';
                break;
            // gateway페이지 query로 넘긴 uid가 미확인된 경우
            case 'NotReceiver':
                $message = 'gateway에 알수없는 접근입니다.';
                break;
            case 'NewsIsChanged':
                $message = '사용자가 접근한 뉴스가 변경되어 삭제되었습니다.';
                break;
            default:
                $message = '알수없는 에러';
                break;
        }
        return $message;
    }

    public function message($situation)
    {
        $message = $this->getMessageContent($situation);

        $client = new Client(['base_uri'=>API_URL, 'verify'=>false]);

        $response = $client->post(
            'sendMessage',
            [
                'query'=>
                [
                    'chat_id'=>'1367642600',
                    'text' => $message
                ]
            ]
        );
    }
}
