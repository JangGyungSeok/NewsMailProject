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

    // 메일 수신자 정보 조회
    public function getAllReceiver()
    {
        $receiverData = $this->receiverRepository
            ->getAll();

        return json_encode($receiverData);
    }

    // 메일 발송시간대별 수신자 정보 조회
    public function getReceiverBySendReservationTime(Request $request)
    {
        $receiverData = $this->receiverRepository
            ->getReceiverBySendReservationTime($request->query('sendReservationTime'));
        // Log::info($receiverData);
        return json_encode($receiverData);
    }

    // 메일 발송 로그 조회
    public function getAllSendMailLog()
    {
        $sendMailLog = $this->mailSendLogRepository->getLogTableContent();

        return json_encode($sendMailLog);
    }

    // 날짜별 메일발송로그 조회
    public function getSendMailLogByMailDate(Request $request)
    {
        $sendMailLog = $this->mailSendLogRepository->getSendMailLogByMailDate($request->query('mailDate'));

        // Log::info($sendMailLog);
        return json_encode($sendMailLog);
    }


}
