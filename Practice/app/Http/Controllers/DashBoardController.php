<?php

namespace App\Http\Controllers;

use App\Service\DashBoardService;
use Illuminate\Http\Request;

class DashBoardController extends Controller
{
    private $dashBoardService;

    public function __construct(DashBoardService $dashBoardService)
    {
        $this->dashBoardService = $dashBoardService;
    }

    public function test()
    {
        return $this->dashBoardService->abc();

    }

    public function mailSendLogDetail($mail_date)
    {
        return $this->dashBoardService->mailSendLogDetail($mail_date);
    }

}
