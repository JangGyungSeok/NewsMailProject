<?php

namespace App\Repository;

use App\ReceiveTimeLog;
use Illuminate\Support\Facades\DB;

class ReceiveTimeLogRepository
{

    protected $receiveTimeLog;

    public function __construct(ReceiveTimeLog $receiveTimeLog)
    {
        $this->receiveTimeLog = $receiveTimeLog;
    }

    public function insertLog($uid, $mailDate)
    {
        return $this->receiveTimeLog->insert(
            [
                'uid' => $uid,
                'mail_date' => $mailDate,
                'enter_time' => date('Y-m-d H:i:s')
            ]
        );
    }

    public function getLogBymailDate($mail_date)
    {
        return $this->receiveTimeLog
            ->join('receivers','uid','=','receivers.idx')
            ->select('uid','receivers.email','mail_date','enter_time')
            ->where('mail_date',$mail_date)
            ->orderBy('enter_time','DESC')
            ->get();
    }

    public function getReceiverFavoriteTime()
    {
        return DB::table('receive_time_logs AS A')
            ->select('A.uid'
                ,DB::raw(
                    "(
                        SELECT
                            DATE_FORMAT(enter_time,'%H:00:00') AS enter_hour
                        FROM
                            receive_time_logs
                        WHERE
                            DATE_FORMAT(enter_time, '%Y-%m-%d') = '2020-07-24'
                            AND uid = A.uid
                            AND DATE_FORMAT(enter_time,'%H:00:00') >= '10:00:00'
                        GROUP BY
                            uid,
                            enter_hour
                        ORDER BY
                            COUNT(enter_hour) DESC,
                            enter_hour ASC
                        LIMIT 1
                    ) as enter_hour"
                )
            )
            ->groupBy('uid')
            ->get();
    }
}
