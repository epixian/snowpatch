<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
	const TYPE_UNKNOWN = 0;
	const TYPE_LEAD = 1;
	const TYPE_CLIENT = 2;
	const TYPE_VENDOR = 3;
	const TYPE_SUBCONTRACTOR = 4;

	const STATUS_UNKNOWN = 0;
	const STATUS_CURRENT = 1;
	const STATUS_ARCHIVED = 2;
	
	protected static $validate = [
		'name' => 'required',
		'address_line_1' => 'required',
		'address_line_2' => 'nullable',
		'city' => 'required',
		'state' => 'required',
		'postal_code' => 'required',
		'country' => 'required',
		'type' => 'nullable|between:0,4',
		'status' => 'nullable|between:0,2'
	];
	protected $guarded = [];
	
	public function jobsites() 
	{
		return $this->hasMany(Jobsite::class);
	}
	
	public function contacts()
	{
		return $this->hasMany(Contact::class);
	}
	
	public static function validated()
	{
		return self::$validate;
	}
	
}

