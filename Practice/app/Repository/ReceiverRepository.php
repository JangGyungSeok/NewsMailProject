<?php

namespace App\Repository;

use App\Receiver;

class ReceiverRepository{

    protected $receiver;

    public function __construct(Receiver $receiver)
    {
        $this->receiver = $receiver;
    }

    public function isReceiver($uid){// $token){
        if ($this->receiver->select('*')->where('idx','=',$uid)->exists()){//->where('token','=','$token')->get()){
            return true;
        } else {
            return false;
        }
    }

    public function getFavoriteTime(){
        return $this->receiver->select('*')->get();
    }
}
