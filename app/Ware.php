<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ware extends Model
{
    protected $fillable = [
        // 'ID_hardiness',
        // 'ID_quality',
        'ID_packaging',
        'name',
        'weight_of_package',
        'archive'
    ];

    // public function hardinessproducts()
    // {
    //   return $this->belongsTo('App\HardinessProduct','ID_hardiness');
    // }
    // public function qualityproducts()
    // {
    //   return $this->belongsTo('App\QualityProduct','ID_quality');
    // }
    public function packagingproducts()
    {
      return $this->belongsTo('App\PackagingProduct','ID_packaging');
    }

    public function position_at_the_loading_dispositions()
    {
        return $this->hasMany('App\PositionAtTheLoadingDisposition');
    }
    public function wares_in_the_boxes()
    {
        return $this->hasMany('App\WaresInTheBox');
    }
}
