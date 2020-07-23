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

    public function Message($situation){
        switch($situation){
            case 'CrawlingFail':
                $message = '크롤링하는 페이지가 변경되었습니다.';
                break;
            case 'MailSendFail':
                $message = '메일 발송이 실패했습니다.';

        }
        $client = new Client(['base_uri'=>API_URL,'verify'=>false]);
        $response = $client->post('sendMessage',
            [
                'query'=>
                [
                    'chat_id'=>'1367642600',
                    'text' => '하이'
                ]
            ]
        );
    }
}
