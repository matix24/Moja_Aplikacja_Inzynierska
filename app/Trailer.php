<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trailer extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'trailer_id_number',
        'capacity',
        'capacity_palete',
        'archive'
    ];
    public function wares_already_loadeds()
    {
        return $this->hasMany('App\WaresAlreadyLoaded');
    }
}
