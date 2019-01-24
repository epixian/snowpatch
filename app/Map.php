<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Map extends Model
{
    /**
     * All of the relationships to be touched when changes occur.
     *
     * @var array
     */
    protected $touches = ['jobsite'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function jobsite()
    {
    	return $this->belongsTo(Jobsite::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function features()
    {
    	return $this->hasOne(MapFeature::class);
    }  

    /**
     * @param \App\MapFeature $feature [description]
     */
    public function addFeature(MapFeature $feature)
    {
    	$this->features()->create(compact('feature'));
    }

 //    /**
 //     * @return 
 //     */
	// public function center()
	// {
	// 	if ($this->map_center) 
	// 	{
	// 		$result = DB::select('
	// 			select ST_Y(map_center) as lat, ST_X(map_center) as lng 
	// 			from maps 
	// 			where jobsite_id = :jobsite_id
	// 		', 
	// 		['jobsite_id' => $this->jobsite_id]);
	// 		$center['lat'] = $result[0]->lat;
	// 		$center['lng'] = $result[0]->lng;
	// 		return (object) $center;
	// 	}
	// 	else
	// 	{
	// 		dd($this);
	// 		// ST_Envelope()
	// 	}
	// } 

    public function type()
    {
    	return $this->map_type;
    }

    public function zoom()
    {
		return $this->map_zoom;
    }

	public function getCenterAttribute()
	{
		$center = unpack('LSRID/Cbyte_order/Lgeometry_type/dlongitude/dlatitude', $this->map_center);
		return (object) [
			'lat' => $center['latitude'],
			'lng' => $center['longitude']
		];
	}

	/**
	 * converts an array in the form of [lat, lng] to well-known binary (WKB) 
	 * format that the internal MySQL database uses to store spatial geometry 
	 * data.  Array parameter must have two elements and can be keyed with 
	 * 'lat' and 'lng' or left unkeyed.  If unkeyed, the first element is 
	 * assumed to be latitude.
	 * 
	 * @param object|array $latLng an object or array consisting of a latitude and a longitude
	 */
	public function setCenterAttribute($latLng)
	{
		$type = MapFeature::TYPE_POINT;
		if (is_object($latLng) && property_exists('lat') && property_exists('lng')) 
		{
			$lat = $latLng->lat;
			$lng = $latLng->lng;
		}
		else if (is_array($latLng))
		{
			if (array_key_exists('lat', $latLng) && array_key_exists('lng', $latLng))
			{
				$lat = $latLng['lat'];
				$lng = $latLng['lng'];
			}
			else if (count($latLng) == 2)
			{
				$lat = $latLng[0];
				$lng = $latLng[1];
			}
		}
		else
			dd($latLng);
		
		$this->attributes['map_center'] = pack('LCLd2', 0, 1, $type, $lng, $lat);
		$this->save();
		return $this->center;
	}

	public function getZoomAttribute()
	{
		return $this->map_zoom;
	}

	public function setZoomAttribute($zoom)
	{
		$this->attributes['map_zoom'] = $zoom;
		$this->save();
		return $this->map_zoom;
	}

}
