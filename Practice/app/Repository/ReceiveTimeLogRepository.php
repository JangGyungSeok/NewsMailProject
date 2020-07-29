<?php

namespace App\Repository;

use App\ReceiveTimeLog;
use Illuminate\Support\Facades\DB;

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

    public function getLogBymailDate($mail_date)
    {
        return $this->receiveTimeLog
        ->join('receivers','uid','=','receivers.idx')
        ->select('uid','receivers.email','mail_date','enter_time')
        ->where('mail_date',$mail_date)
        ->orderBy('enter_time','DESC')
        ->get();
    }

    public function getReceiverFavoriteTime(){

        // SELECT
        // A.uid,
	    //     (
        //         SELECT
        //         DATE_FORMAT(enter_time,'%H:00:00') AS enter_hour
        //         #COUNT(*) AS enter_count
        //         FROM receive_time_logs
        //         WHERE date_format(enter_time,'%Y-%m-%d') = '2020-07-24' AND uid = A.uid
        //         GROUP BY uid, enter_hour
        //         ORDER BY COUNT(enter_hour) DESC, enter_hour ASC
        //         LIMIT 1
	    //     ) AS enter_hour
        // FROM receive_time_logs A
        // GROUP BY uid;

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
            // ->addSelect([DB::raw('enter_hour')
            //     =>DB::table('receive_time_logs')
            //     ->select(DB::raw("DATE_FORMAT(enter_time, '%H:00:00') AS enter_hour"))
            //     ->where(
            //         [
            //             [DB::raw("date_format(enter_time, '%Y-%m-%d')"), '2020-07-24'],
            //             ['uid','A.uid']
            //         ]
            //     )
            //     ->groupBy(['uid','enter_hour'])
            //     ->orderBy(DB::raw("COUNT(enter_hour)"),'DESC')
            //     ->orderBy(DB::raw('enter_hour'),'ASC')
            //     ->getQuery()
            // ])
            ->groupBy('uid')
            ->get();

        // return $this->receiveTimeLog
        // ->select(
        //     'uid',
        //     DB::raw("DATE_FORMAT(enter_time,'%H:00:00') as enter_hour")
        // )
        // ->where(DB::raw("date_format(enter_time,'%Y-%m-%d')") , '=' , '2020-07-24')
        // ->groupBy(['uid','enter_hour'])
        // ->limit(1)
        // ->get();
    }
}
