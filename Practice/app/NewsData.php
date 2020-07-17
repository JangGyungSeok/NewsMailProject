<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class NewsData extends Model
{
    public function insertNews($data){

        return \App\NewsData::insert(
            [
                'news_date' => $data[0],
                'news_title' => $data[1],
                'news_url' => $data[2]
            ]
        );

    }
}
