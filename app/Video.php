<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    public function vibs(){
        return $this->hasMany('App\vibs');
    }


    protected $dates = [
        'converted_for_streaming_at',
    ];
    protected $guarded = [];
}
