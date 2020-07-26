<?php

namespace App\Repository;

use App\ReceiveTimeLog;

class ReceiveTimeLogRepository{

    protected $receiveTimeLog;

    public function __construct(ReceiveTimeLog $receiveTimeLog)
    {
        $this->receiveTimeLog = $receiveTimeLog;
    }

    public function insertLog($uid,$mailDate){
        return $this->receiveTimeLog->insert(
            [
                //uid로 변경예정
                'uid' => $uid,
                'mail_date' => $mailDate,
                'enter_time' => date('Y-m-d H:i:s')
            ]
        );
    }
}
