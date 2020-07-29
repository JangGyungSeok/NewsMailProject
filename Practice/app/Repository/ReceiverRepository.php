<?php

namespace App\Repository;

use App\Receiver;

class ReceiverRepository{

    protected $receiver;

    public function __construct(Receiver $receiver)
    {
        $this->receiver = $receiver;
    }

    public function isReceiver($uid)
    {
        if ($this->receiver->select('*')->where('idx','=',$uid)->exists()){//->where('token','=','$token')->get()){
            return true;
        } else {
            return false;
        }
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
}
