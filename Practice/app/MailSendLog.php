<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MailSendLog extends Model
{
    public function insertMailSentLog(){

    }

    public function receiver(){
        return $this->belongTo('App\Receiver','foreign_key','token');
    }

    public function insertLog($uid, $isSuccess){
        return MailSendLog::insert(
            [
                'send_time' => date('Y-m-d h:i:s'),
                'token' => $uid,
                'is_success' => $isSuccess
            ]
        );
    }
}
