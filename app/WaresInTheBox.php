<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WaresInTheBox extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
    protected $fillable = [
        'ID_boxpallet',
        'ID_ware',
        'ID_seller',
        'quantity',
        'amount'
    ];

    public function box_pallets()
    {
      return $this->belongsTo('App\BoxPallet','ID_boxpallet');
    }
    public function waress()
    {
      return $this->belongsTo('App\Ware','ID_ware');
    }
    public function sellers()
    {
      return $this->belongsTo('App\Seller','ID_seller');
    }
}
