<?php

namespace App\Http\Controllers;

use App\Exceptions\CustomException;
use App\Service\GatewayService;
use App\Service\TelegramService;
use Illuminate\Http\Request;

class GatewayController extends Controller
{

    private $gatewayService;

    public function __construct(
        GatewayService $gatewayService
    ) {
        $this->gatewayService = $gatewayService;
    }

    // 게이트웨이 접근 Service로직 호출
    public function enterGateway(Request $request)
    {
        $result = $this->gatewayService->enterGateway($request);
        return $result;
    }

    // public function testGateway(){
    //     $temp = new TelegramService;
    //     return $temp->testMessage();
    // }
}
