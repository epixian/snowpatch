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
	 * @static array
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
		'organization_id' => 'required',
		'lat' => 'nullable|numeric|between:-90,90',
		'long' => 'nullable|numeric|between:-180,180'
	];
	
	/**
	 * Attributes that are not mass assignable
	 * 
	 * @var array
	 */
    protected $guarded = [];
	
    /**
     * All of the relationships to be touched when changes occur.
     *
     * @var array
     */
    protected $touches = ['organization'];

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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
	public function organization()
	{
		return $this->belongsTo(Organization::class);
	}
	
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
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


	public function updateMap($features, $options)
	{
		$updateCenter = true;
		if (array_key_exists('center', $options)) {
			$updateCenter = false;
			$this->map->setCenter($options['center']);
		}
		if (array_key_exists('zoom', $options))
			$this->map->setZoom($options['zoom']);
		$this->map->featuresFromGeoJSON($features, $updateCenter);
		$this->save();
	}

	public function updateMeasurements($measurements)
	{
		// dd($measurements);
		if (array_key_exists('linear_feet', $measurements))
			$this->linear_feet = $measurements['linear_feet'];
		if (array_key_exists('acreage', $measurements))
			$this->acreage = $measurements['acreage'];
		$this->save();
	}
}
