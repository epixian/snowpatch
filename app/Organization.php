<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
	protected $guarded = [];
	
	public function jobsites() 
	{
		return $this->hasMany(Jobsite::class);
	}
}

