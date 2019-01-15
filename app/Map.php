<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Map extends Model
{
    /**
     * All of the relationships to be touched when changes occur.
     *
     * @var array
     */
    protected $touches = ['organization'];//

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function jobsite()
    {
    	return $this->belongsTo(Jobsite::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function features()
    {
    	return $this->hasMany(MapFeature::class);
    }  
}
