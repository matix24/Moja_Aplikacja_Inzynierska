<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RelationshipRelationWithList extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
      protected $fillable = [
          'ID_disposition',
          'ID_position'
      ];

    public function loading_instructions()
    {
      return $this->belongsTo('App\LoadingInstruction','ID_disposition');
    }
    public function position_at_the_loading_dispositions()
    {
      return $this->belongsTo('App\PositionAtTheLoadingDisposition','ID_position');
    }
}
