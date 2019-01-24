<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MapFeature extends Model
{
	/**
	 * Database POINT operations:
	 * 
	 * ST_X(p) -> get longitude component of Point p
	 * ST_Y(p) -> get latitude component of Point p
	 * ST_Envelope(g) -> get minimum bounding rectangle (MBR) around Geometry g
	 * ST_Length(ls) -> get length of LineString or MultiLineString ls
	 * ST_Area(poly) -> get area of Polygon or MultiPolygon poly
	 *
	 * Point(x, y) -> define a point
	 *   e.g. Point($long, $lat)
	 * LineString(x1 y1, x2 y2, ...) -> define a sequence of connected points
	 *
	 * ST_AsText(g) -> convert Geometry to text
	 * ST_GeomFromText($text) -> convert text to Geometry
	 * ST_AsGeoJSON(g) -> convert Geometry to GeoJSON
	 * ST_GeomFromGeoJSON(str) -> convert GeoJSON to Geometry
	 * ST_IsValid(g) -> check if Geometry g is valid and well-formed
	 *
	 * Example:
	 *   ST_AsText(ST_Envelope(ST_GeomFromText('LineString(1 1,2 2)')))
	 */
	
	const TYPE_POINT = 1;
	const TYPE_LINESTRING = 2;
	const TYPE_POLYGON = 3;
	const TYPE_MULTIPOINT = 4;
	const TYPE_MULTILINESTRING = 5;
	const TYPE_MULTIPOLYGON = 6;
	const TYPE_GEOMETRYCOLLECTION = 7;

    /**
     * All of the relationships to be touched when changes occur.
     *
     * @var array
     */
    protected $touches = ['map'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function map()
    {
    	return $this->belongsTo(Map::class);
    }

}
