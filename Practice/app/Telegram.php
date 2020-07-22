<?php

namespace App;

use \GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

define('BOT_TOKEN',env('TELEGRAM_BOT_TOKEN'));
define('API_URL','http://api.telegram.org/bot'.BOT_TOKEN.'/');

class Telegram
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
            ]);

        return $response->getBody();
        // return $updates;
    }
}
