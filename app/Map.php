<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Map extends Model
{
    
    // $table->increments('id');
    // $table->unsignedInteger('jobsite_id');
    // $table->string('name')->nullable();
    // $table->string('status')->default('draft');
    // $table->point('map_center')->nullable();
    // $table->unsignedTinyInteger('map_zoom')->default(18);
    // $table->string('map_type')->default('satellite');
    // $table->timestamps();
    protected static $validate = [
    ];

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
    	return $this->hasMany(MapFeature::class);
    }  

    /**
     * @param \App\MapFeature $feature [description]
     */
    public function setFeature(MapFeature $feature)
    {
    	$this->features->updateOrCreate(compact('feature'));
    }

    public function hasFeatures()
    {
    	return $this->features != null;
    }

    public function featuresAsGeoJSON($description = 'all')
    {
        return MapFeature::asGeoJSON($this, $description);
    }

    public function featuresFromGeoJSON($json, $updateCenter = true)
    {
        MapFeature::fromGeoJSON($this, $json, $updateCenter);
    }

    public function type()
    {
    	return $this->map_type;
    }

  //   public function zoom()
  //   {
		// return $this->map_zoom;
  //   }

	public function getCenter()
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
    public function setCenter($latLng)
    {
        // dd('one',$latLng);
        $lat = 0;
        $lng = 0;
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
                dd('two',$lat,$lng);
			}
			else 
            {
                if (count($latLng) == 2)
    			{
    				$lat = $latLng[0];
    				$lng = $latLng[1];
    			}

            }
		}
		else if (is_string($latLng))
        {
			$latLng = str_replace(["(", "(", " "], "", $latLng);
            list($lat, $lng) = explode(",", $latLng);
        }
        else 
        {
            dd('Not an object, array, or string: ' . $latLng);
        }
        $wkb = pack('LCLd2', 0, 1, $type, $lng, $lat);
        // dd('four',$lat,$lng,$wkb);
    	$this->map_center = $wkb;
    	$this->save();
    	return $this->center;
    }

	public function getZoom()
	{
		return $this->map_zoom;
	}

	public function setZoom($zoom)
	{
		$this->attributes['map_zoom'] = $zoom;
		$this->save();
		return $this->map_zoom;
	}

}
