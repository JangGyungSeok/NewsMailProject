<?php

namespace App\Service;

use App\Repository\MailSendLogRepository;
use App\Repository\ReceiveTimeLogRepository;
use Illuminate\Support\Facades\Log;
use Exception;

class DashBoardService{

    protected $mailSendLogRepository;
    protected $receiveTimeLogRepository;

    public function __construct(
        MailSendLogRepository $mailSendLogRepository,
        ReceiveTimeLogRepository $receiveTimeLogRepository
    )
    {
        $this->mailSendLogRepository = $mailSendLogRepository;
        $this->receiveTimeLogRepository = $receiveTimeLogRepository;
    }

    public function abc(){
        return $this->mailSendLogRepository->getLogTableContent();
    }

    public function mailSendLogDetail($mail_date)
    {
        return $this->receiveTimeLogRepository->getLogBymailDate($mail_date);
    }
}
