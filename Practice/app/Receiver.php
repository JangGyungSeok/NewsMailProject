<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Receiver extends Model
{
    public $timestamps = false;
    # 수신자(1) : 메일유입로그(다수) 관계 설정
    public function receiveTimeLog()
    {
        return $this->hasMany('App\ReceiveTimeLog', 'foreign_key', 'idx');
    }

    # 수신자(1) : 메일발송로그(다수) 관계 설정
    public function mailSendLog()
    {
        return $this->hasMany('App\MailSendLog', 'foreign_key', 'idx');
    }
}
