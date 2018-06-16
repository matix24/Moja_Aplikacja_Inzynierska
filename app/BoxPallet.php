<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BoxPallet extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
    protected $fillable = [
        'ID_wares_already_loaded',
        'number_boxes'
    ];
    
    public function wares_already_loadeds()
    {
      return $this->belongsTo('App\WaresAlreadyLoaded','ID_wares_already_loaded');
    }

    public function wares_in_the_boxes()
    {
        return $this->hasMany('App\WaresInTheBox');
    }
}
