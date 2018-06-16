<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PositionAtTheLoadingDisposition extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
    protected $fillable = [
        'ID_wares',
        'ID_sellers',
        'weight_per_package',
        'amount',
        'priority'
    ];

    public function wares()
    {
      return $this->belongsTo('App\Ware','ID_wares');
    }
    public function sellers()
    {
      return $this->belongsTo('App\Seller','ID_sellers');
    }

    public function relationship_relation_with_lists()
    {
        return $this->hasMany('App\RelationshipRelationWithList');
    }
}
