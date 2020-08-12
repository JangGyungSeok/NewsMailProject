<?php

namespace App\Repository;

use App\Receiver;

class ReceiverRepository
{

    protected $receiver;

    public function __construct(Receiver $receiver)
    {
        $this->receiver = $receiver;
    }

    // 사용자 판별
    public function isReceiver($uid)
    {
        return $this->receiver
            ->select('*')
            ->where('idx','=',$uid)
            ->exists();
    }

    // 수신자 선호시간 조회
    public function getFavoriteTime()
    {
        return $this->receiver->select('*')->get();
    }

    // 수신자 메일발송시간 변경
    public function updateReservationTime($uid, $favoriteTime)
    {
        // $this->receiver->
        $this->receiver
            ->where('idx',$uid)
            ->update(['send_reservation_time' => $favoriteTime]);

    }

    // 수신자 정보 전체조회
    public function getAll()
    {
        return $this->receiver->get();
    }


    // 수신자 정보 선호시간별 조회
    public function getReceiverBySendReservationTime($data)
    {
        return $this->receiver->select('*')->where('send_reservation_time',$data)->get();
    }
}
