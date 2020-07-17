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
}
