<?php

namespace App;

use Illuminate\Support\Facades\DB;
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

    public static function asGeoJSON($map, $description = 'all')
    {
        $result = DB::table('map_features')
            ->selectRaw('ST_AsGeoJSON(geometry) as geometry, description')
            ->where('map_id', $map->id)
            ->get();

        // build GeoJSON object
        $features = [];
        for ($i = 0; $i < count($result); $i++) 
        {
            if($result[$i]->description == $description || $description == 'all')
            {
                $feature = [
                    'type' => 'Feature',
                    'geometry' => json_decode($result[$i]->geometry),
                    'properties' => [
                        'description' => $result[$i]->description
                    ]
                ];
                array_push($features, $feature);
            }
        }
        $json = ['type' => 'FeatureCollection', 'features' => $features];
        return json_encode($json);
    }

    public static function fromGeoJson($map, $json, $updateCenter = true)
    {
        $json = json_decode($json);

        // map each description/activity to its stored-as geometry type
        $descriptions = [
            'Plowing' => 'Polygon',
            'Shoveling' => 'LineString',
            'Entry' => 'Point'
        ];

        DB::beginTransaction();

        // delete previous features
        DB::table('map_features')
            ->where('map_id', $map->id)
            ->delete();

        // insert new/updated features
        foreach ($json->features as $feature)
        {

            DB::table('map_features')
                ->insert([
                    'map_id' => $map->id,
                    'geometry' => DB::raw('ST_GeomFromGeoJSON(\'' . json_encode($feature->geometry) . '\')'),
                    'description' => '\'' . $feature->properties->description . '\''
                ]);
        }

        // set new map center
        if ($updateCenter) 
        {
            $result = DB::table('map_features')
                ->selectRaw('ST_AsGeoJSON(ST_Envelope(ST_GeomFromGeoJSON(\'' . json_encode($json) . '\'))) as bounds')
                ->limit(1)
                ->get();
            $mbr = json_decode($result[0]->bounds)->coordinates[0];
            $map->setCenter([
                'lat' => ($mbr[2][1] + $mbr[0][1]) / 2,
                'lng' => ($mbr[2][0] + $mbr[0][0]) / 2
            ]);
        }

        DB::commit();
    }
}