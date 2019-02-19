<?php

namespace App\Http\Controllers;

use App\Map;
use App\Jobsite;
use Illuminate\Http\Request;

class JobsiteMapsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Jobsite  $jobsite
     * @return \Illuminate\Http\Response
     */
    public function show(Jobsite $jobsite)
    {
        $map = $jobsite->map;
        return view('maps.show', compact('map'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Map  $map
     * @return \Illuminate\Http\Response
     */
    public function edit(Jobsite $jobsite)
    {
        $map = $jobsite->map;
        return view('maps.edit', compact('map'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Jobsite $jobsite)
    {
        // dd($request);
        $geojson = $request->input('geojson');
        $options = [];
        if ($request->has('center'))
            $options['center'] = $request->input('center');
        if ($request->has('zoom')) 
            $options['zoom'] = $request->input('zoom');
        $jobsite->updateMap($geojson, $options);

        $measurements = [];
        if ($request->has('linear_feet')) 
            $measurements['linear_feet'] = $request->input('linear_feet');
        if ($request->has('acreage'))
            $measurements['acreage'] = $request->input('acreage');
        $jobsite->updateMeasurements($measurements);

        return redirect('/jobsites/' . $jobsite->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Map  $map
     * @return \Illuminate\Http\Response
     */
    public function destroy(Map $map)
    {
        //
    }
}
