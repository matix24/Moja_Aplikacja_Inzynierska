<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PackagingProduct extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
    protected $fillable = [
        'name',
        'archive'
    ];

    public function wares()
    {
        return $this->hasMany('App\Ware');
    }
}
