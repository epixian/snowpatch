<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Jobsite extends Model
{
	use Sortable;
	
	const TYPE_UNKNOWN = 0;
	const TYPE_RESIDENTIAL = 1;
	const TYPE_COMMERCIAL = 2;
	const TYPE_GOVERNMENT = 3;
	const TYPE_MEDICAL = 4;
	const TYPE_RELIGIOUS = 5;
	
	const STATUS_UNKNOWN = 0;
	const STATUS_ACTIVE = 1;
	const STATUS_INACTIVE = 2;
	const STATUS_PENDING = 3;
	
	/**
	 * Validation schema for class attributes
	 * 
	 * @var array
	 */
	protected static $validate = [
		'name' => 'required',
		'address' => 'required',
		'city' => 'required',
		'state' => 'required',
		'postal_code' => 'required',
		'country' => 'required',
		'acreage' => 'nullable|gte:0',
		'linear_feet' => 'nullable|gte:0',
		'type' => 'nullable|between:0,5',
		'status' => 'nullable|between:0,3',
		'organization_id' => 'required'
	];
	
	/**
	 * Attributes that are not mass assignable
	 * 
	 * @var array
	 */
    protected $guarded = [];
	
	/**
	 * Attributes that can be sorted
	 * 
	 * @var array
	 */
	public $sortable = [
		'name',
		'address',
		'city',
		'state',
		'postal_code',
		'country',
		'acreage',
		'linear_feet',
		'type',
		'status',
		'organization_id'
	];

	/**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
	public function organization()
	{
		return $this->belongsTo(Organization::class);
	}
	
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
	public function map()
	{
		return $this->hasOne(Map::class);
	}

    /**
     * @return array|null
     */
	public static function validated()
	{
		return self::$validate;
	}

}
