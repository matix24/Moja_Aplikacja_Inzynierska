<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'surname',
        'address',
        'phone_number',
        'archive'
    ];

    public function position_at_the_loading_dispositions()
    {
        return $this->hasMany('App\PositionAtTheLoadingDisposition');
    }
    public function wares_in_the_boxes()
    {
        return $this->hasMany('App\WaresInTheBox');
    }
}
