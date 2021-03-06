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

    public function isReceiver($uid)
    {
        return $this->receiver
            ->select('*')
            ->where('idx','=',$uid)
            ->exists();
    }

    public function getFavoriteTime()
    {
        return $this->receiver->select('*')->get();
    }

    public function updateReservationTime($uid, $favoriteTime)
    {
        // $this->receiver->
        $this->receiver
            ->where('idx',$uid)
            ->update(['send_reservation_time' => $favoriteTime]);

    }

    public function getAll()
    {
        return $this->receiver->get();
    }


    public function getReceiverBySendReservationTime($data)
    {
        return $this->receiver->select('*')->where('send_reservation_time',$data)->get();
    }
}
