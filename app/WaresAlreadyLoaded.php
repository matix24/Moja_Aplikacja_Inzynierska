<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WaresAlreadyLoaded extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
      protected $fillable = [
          'ID_truck',
          'ID_trailer',
          'ID_disposition'
      ];

    public function trucks()
    {
      return $this->belongsTo('App\Truck','ID_truck');
    }
    public function trailers()
    {
      return $this->belongsTo('App\Trailer','ID_trailer');
    }
    public function loading_instructions()
    {
      return $this->belongsTo('App\LoadingInstruction','ID_disposition');
    }

    public function users_to_loads()
    {
        return $this->hasMany('App\UserToLoad');
    }

    public function box_pallets()
    {
        return $this->hasMany('App\BoxPallet');
    }
}
