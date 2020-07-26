<?php

namespace App;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MailSendLog extends Model
{
    public function receiver(){
        return $this->belongTo('App\Receiver','foreign_key','token');
    }
}
