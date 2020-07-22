<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Receiver extends Model
{
    # 수신자(1) : 메일유입로그(다수) 관계 설정
    public function receiveTimeLog(){
        return $this->hasMany('App\ReceiveTimeLog','foreign_key','token');
    }

    # 수신자(1) : 메일발송로그(다수) 관계 설정
    public function mailSendLog(){
        return $this->hasMany('App\MailSendLog','foreign_key','token');
    }

    public function getReceiver(){

    }
    public function isReceiver($uid){// $token){
        if (Receiver::select('*')->where('idx','=',$uid)->exists()){//->where('token','=','$token')->get()){
            return true;
        } else {
            return false;
        }
    }
    public function getFavoriteTime(){
        return Receiver::select('*')->get();
    }
}
