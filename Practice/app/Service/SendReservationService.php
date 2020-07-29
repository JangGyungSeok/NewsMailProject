<?php

namespace App\Service;

use App\Repository\ReceiverRepository;
use App\Repository\ReceiveTimeLogRepository;
use Illuminate\Support\Facades\Log;

class SendReservationService{

    protected $receiverRepository;
    protected $receiveTimeLogRepository;


    public function __construct(
        ReceiverRepository $receiverRepository,
        ReceiveTimeLogRepository $receiveTimeLogRepository
    )
    {
        $this->receiverRepository = $receiverRepository;
        $this->receiveTimeLogRepository = $receiveTimeLogRepository;
    }

    public function updateReservationTime(){
        // $receivers = $this->receiverRepository->getAll();

        // foreach($receivers as $receiver){

        // }

        $favoriteTimes = $this->receiveTimeLogRepository->getReceiverFavoriteTime();
        if(!($favoriteTimes->isEmpty())){
            foreach($favoriteTimes as $data){
                if($this->receiverRepository->isReceiver($data->uid)){
                    // 업데이트 메서드 실행
                    $this->receiverRepository->updateReservationTime($data->uid, $data->enter_hour);
                }
            }
            return $favoriteTimes;
        }
    }
}
