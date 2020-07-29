<?php

namespace App\Repository;

use Exception;
use App\MailSendLog;
use App\Service\MailSendService;
use Illuminate\Support\Facades\DB;

class MailSendLogRepository
{
    protected $mailSendLog;

    public function __construct(MailSendLog $mailSendLog)
    {
        $this->mailSendLog = $mailSendLog;
    }

    public function insertLog($uid, $isSuccess)
    {
        return $this->mailSendLog->insert(
            [
                'send_time' => date('Y-m-d h:i:s'),
                'uid' => $uid,
                'is_success' => $isSuccess
            ]
        );
    }

    public function getLogTableContent()
    {
        // 발송날짜를 기준으로 group by
        // 각 날짜별 발송성공, 실패 보여줌
        // 내 로직 특성 상 오늘 이전 데이터만 보여줘야함
        $logTable = $this->mailSendLog
            ->select(
                DB::raw("date_format(send_time, '%Y-%m-%d') as mail_date"),
                DB::raw('count(uid) as total_send'),
                DB::raw('COUNT(if(is_success=1,is_success,null)) as send_success'),
                DB::raw('COUNT(if(is_success=0,is_success,null)) as send_fail')
            )
            ->groupBy('mail_date')
            ->orderBy('mail_date','DESC')
            ->get();

        return $logTable;
    }
}
