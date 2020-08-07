<?php

namespace App\Http\Controllers;

use App\Repository\MailSendLogRepository;
use App\Repository\NewsDataRepository;
use App\Repository\ReceiverRepository;
use App\Repository\ReceiveTimeLogRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AjaxController extends Controller
{
    protected $mailSendLogRepository;
    protected $receiveTimeLogRepository;
    protected $newsDataRepository;
    protected $receiverRepository;

    public function __construct(
        MailSendLogRepository $mailSendLogRepository,
        ReceiveTimeLogRepository $receiveTimeLogRepository,
        NewsDataRepository $newsDataRepository,
        ReceiverRepository $receiverRepository
    ) {
        $this->newsDataRepository = $newsDataRepository;
        $this->mailSendLogRepository = $mailSendLogRepository;
        $this->receiveTimeLogRepository = $receiveTimeLogRepository;
        $this->receiverRepository = $receiverRepository;
    }

    public function getAllReceiver()
    {
        $receiverData = $this->receiverRepository
            ->getAll();

        return json_encode($receiverData);
    }
    public function getReceiverBySendReservationTime(Request $request)
    {
        $receiverData = $this->receiverRepository
            ->getReceiverBySendReservationTime($request->query('sendReservationTime'));
        // Log::info($receiverData);
        return json_encode($receiverData);
    }

    public function getAllSendMailLog()
    {
        $sendMailLog = $this->mailSendLogRepository->getLogTableContent();

        return json_encode($sendMailLog);
    }

    public function getSendMailLogByMailDate(Request $request)
    {
        $sendMailLog = $this->mailSendLogRepository->getSendMailLogByMailDate($request->query('mailDate'));

        // Log::info($sendMailLog);
        return json_encode($sendMailLog);
    }


}
