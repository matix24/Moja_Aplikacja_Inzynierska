<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Truck extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'truck_id_number',
        'capacity',
        'capacity_palete',
        'archive'
    ];

    public function wares_already_loadeds()
    {
        return $this->hasMany('App\WaresAlreadyLoaded');
    }
}
