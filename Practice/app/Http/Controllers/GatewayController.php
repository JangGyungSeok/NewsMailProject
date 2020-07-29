<?php

namespace App\Http\Controllers;

use App\Exceptions\CustomException;
use App\Service\GatewayService;
use App\Service\TelegramService;
use Illuminate\Http\Request;

class GatewayController extends Controller
{

    private $gatewayService;
    private $telegramService;

    public function __construct(
        GatewayService $gatewayService,
        TelegramService $telegramService
    ) {
        $this->gatewayService = $gatewayService;
        $this->telegramService = $telegramService;
    }

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
