<?php

namespace App\Service;

use App\Repository\MailSendLogRepository;
use Illuminate\Support\Facades\Log;
use Exception;

class DashBoardService{

    protected $mailSendLogRepository;
    public function __construct(MailSendLogRepository $mailSendLogRepository)
    {
        $this->mailSendLogRepository = $mailSendLogRepository;
    }

    public function abc(){
        return $this->mailSendLogRepository->getLogTableContent();
    }
}
