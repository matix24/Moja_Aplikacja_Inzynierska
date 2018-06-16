<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QualityProduct extends Model
{
    public function wares()
    {
        return $this->hasMany('App\Ware');
    }
}
