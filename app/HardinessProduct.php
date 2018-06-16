<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HardinessProduct extends Model
{
    public function wares()
    {
        return $this->hasMany('App\Ware');
    }
}
