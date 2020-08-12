<?php

namespace App\Service;

use Illuminate\Support\Facades\Log;
use App\Repository\ReceiverRepository;
use App\Repository\ReceiveTimeLogRepository;

class SendReservationService
{
    protected $receiverRepository;
    protected $receiveTimeLogRepository;

    public function __construct(
        ReceiverRepository $receiverRepository,
        ReceiveTimeLogRepository $receiveTimeLogRepository
    ) {
        $this->receiverRepository = $receiverRepository;
        $this->receiveTimeLogRepository = $receiveTimeLogRepository;
    }

    public function updateReservationTime()
    {

        // 어제자 최다유입시간 조회
        $favoriteTimes = $this->receiveTimeLogRepository->getReceiverFavoriteTime();
        Log::info($favoriteTimes);

        // 어제자 유입시간이 없을경우 미실행
        if (!($favoriteTimes->isEmpty())) {
            foreach ($favoriteTimes as $data) {
                if ($this->receiverRepository->isReceiver($data->uid) && $data->enter_hour != null) {
                    // 업데이트 메서드 실행
                    $this->receiverRepository->updateReservationTime($data->uid, $data->enter_hour);
                }
            }
            return $favoriteTimes;
        }
    }
}
