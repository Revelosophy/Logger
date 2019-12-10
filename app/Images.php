<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Images extends Model
{
    public function user(){
        return $this->belongsTo('App\User');
    }

    public function log(){
        return $this->belongsTo ('App\Logs');
    }
}
