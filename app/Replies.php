<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Replies extends Model
{
    public function log(){
        return $this->belongsTo('App\Logs');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }
}
