<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReceiveTimeLog extends Model
{
    //

    public function receiver(){
        return $this->belongsTo('App\Receiver','foreign_key','token');
    }



}
