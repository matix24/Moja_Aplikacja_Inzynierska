<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoadingInstruction extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
    protected $fillable = [
        'date',
        'amount',
        'archive'
    ];

    public function relationship_relation_with_lists()
    {
        return $this->hasMany('App\RelationshipRelationWithList');
    }
    public function wares_already_loadeds()
    {
        return $this->hasMany('App\WaresAlreadyLoaded');
    }
}
