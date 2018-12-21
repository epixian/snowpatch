<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jobsite extends Model
{
	const TYPE_UNKNOWN = 0;
	const TYPE_RESIDENTIAL = 1;
	const TYPE_COMMERCIAL = 2;
	const TYPE_GOVERNMENT = 3;
	
	protected static $validate = [
		'name' => 'required',
		'address' => 'required',
		'city' => 'required',
		'state' => 'required',
		'postal_code' => 'required',
		'country' => 'required',
		'type' => 'nullable|between:0,3'
	];
    protected $guarded = [];
	
	public function organization()
	{
		return $this->belongsTo(Organization::class);
	}

	public function map()
	{
		return $this->hasOne(Map::class);
	}

}
