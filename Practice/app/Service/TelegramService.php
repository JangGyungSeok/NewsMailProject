<?php

namespace App\Service;

use \GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

define('BOT_TOKEN',env('TELEGRAM_BOT_TOKEN'));
define('API_URL','http://api.telegram.org/bot'.BOT_TOKEN.'/');

class TelegramService
{
    public function testMessage(){
        $client = new Client(['base_uri'=>API_URL,'verify' => false]);

        $response = $client->post('sendMessage',
            [
                'query'=>
                [
                    'chat_id'=>'1367642600',
                    'text' => '하이'
                ]
            ]
        );

        return $response->getBody();
        // return $updates;
    }

    public function getMessageContent($situation){
        switch($situation){
            // 뉴스포털 URL이 문제있는경우
            case 'CrawlingURLFail':
                $message = '크롤링할 페이지가 없습니다.';
                break;
            // 크롤링 시 CSSSeletor가 이상할경우
            case 'NotGoodCSSSelector':
                $message = '잘못된 CSS Selector를 입력했습니다.';
                break;
            case 'ChangeArchitecture':
                $message = '크롤링할 페이지 구조가 변경되었습니다.';
                break;
            case 'MailAPIFail':
                $message = 'Mail발송 API가 동작하지 않습니다.';
                break;
            case 'MailSendFail':
                $message = '메일 발송이 실패했습니다.';
                break;
            case 'Fail':
                $message = '메일 발송에 알수없는 오류 발생';
                break;
        }
        return $message;
    }
    public function message($situation){
        $message = $this->getMessageContent($situation);

        $client = new Client(['base_uri'=>API_URL,'verify'=>false]);

        $response = $client->post('sendMessage',
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
