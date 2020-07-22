<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReceiveTimeLog extends Model
{
    //

    public function receiver(){
        return $this->belongsTo('App\Receiver','foreign_key','token');
    }


    public function insertLog($uid,$mailDate){
        return ReceiveTimeLog::insert(
            [
                //uid로 변경예정
                'uid' => $uid,
                'mail_date' => $mailDate,
                'enter_time' => date('Y-m-d h:i:s')
            ]
        );
    }
}
