<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jobsite extends Model
{
    protected $guarded = [];
	
	public function organization()
	{
		return $this->belongsTo(Organization::class);
	}
}
