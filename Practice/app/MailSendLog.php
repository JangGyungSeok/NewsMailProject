<?php

namespace App;

use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;

class MailSendLog extends Model
{
    public $timestamps = false;

    public function receiver()
    {
        return $this->belongTo('App\Receiver', 'foreign_key', 'idx');
    }
}
