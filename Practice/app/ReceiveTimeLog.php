<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReceiveTimeLog extends Model
{
    //

    public function receiver(){
        return $this->belongsTo('App\Receiver','foreign_key','token');
    }


    public function insertLog($uid){
        return ReceiveTimeLog::insert(
            [
                //uid로 변경예정
                'token' => $uid,
                'mail_date' => date('Y-m-d'),
                'enter_time' => date('Y-m-d h:i:s')
            ]
        );
    }
}
