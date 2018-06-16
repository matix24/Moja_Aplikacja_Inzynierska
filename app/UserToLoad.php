<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserToLoad extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
    protected $fillable = [
        'ID_employee',
        'ID_wares_already_loaded'
    ];
    public function employees()
    {
      return $this->belongsTo('App\User','ID_employee');
    }
    public function wares_already_loadeds()
    {
      return $this->belongsTo('App\WaresAlreadyLoaded','ID_wares_already_loaded');
    }
}
