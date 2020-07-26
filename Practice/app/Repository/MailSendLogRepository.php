<?php

namespace App\Repository;

use App\MailSendLog;
use Exception;

class MailSendLogRepository{
    protected $mailSendLog;

    public function __construct(MailSendLog $mailSendLog)
    {
        $this->mailSendLog = $mailSendLog;
    }

    public function insertLog($uid, $isSuccess){
        return MailSendLog::insert(
            [
                'send_time' => date('Y-m-d h:i:s'),
                'uid' => $uid,
                'is_success' => $isSuccess
            ]
        );
    }

    public function getLogTableContent(){
        // $logTable = MailSendLog::select(
        //     'date_format(send_time),
        //     count(uid),
        //     count(if(is_success=1,is_success,null)),
        //     count(if(is_success=0,is_success,null))'
        // )
        // // 오늘 이전꺼만 가져오도록 조건추가
        // ->groupBy('date_format(send_time)')
        // ->get();
        $logTable = $this->mailSendLog
            ->select('*')
            ->get();
        // $logTable = MailSendLog::select('count(send_time)')
        // // 오늘 이전꺼만 가져오도록 조건추가
        // ->get();

        return $logTable;

    }
}
