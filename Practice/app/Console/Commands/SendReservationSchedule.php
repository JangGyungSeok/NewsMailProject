<?php

namespace App\Console\Commands;

use App\Service\SendReservationService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class SendReservationSchedule extends Command
{
    protected $sendReservationService;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:SendReservationSchedule';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(SendReservationService $sendReservationService)
    {
        $this->sendReservationService = $sendReservationService;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Log::info('메일발송시간 스케줄 시작!');
        $result = $this->sendReservationService->updateReservationTime();
        Log::info('메일발송시간 스케줄 끝!');
    }
}
