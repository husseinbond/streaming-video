<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vibs extends Model
{

    public function video(){
        return $this->belongsTo('app/video');
    }


    protected $guarded = [];
}
